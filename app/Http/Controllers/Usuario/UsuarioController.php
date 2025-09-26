<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // ✅ import correcto (arriba, fuera de la clase)
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios
     */
    public function index()
    {
        // Carga todos los usuarios con su relación a la tabla users
        $usuarios = Usuario::with(['user','role'])->latest('id_usuario')->get();

        // Si usas vista Blade
        return view('usuario.index', compact('usuarios'));

        // Si usas API o JSON, descomenta esta línea:
        // return response()->json($usuarios);
    }

    public function create()
    {
        return view('usuario.create');
    }


    /**
     * Crear nuevo usuario
     */

    public function store(Request $request)
    {
        // Valida exactamente lo que vas a guardar (sin “normalizar”)
        $request->validate([
            'nombre'            => ['required','string','max:255'],
            'apellido'          => ['nullable','string','max:255'],
            'email'             => ['required','email','max:255'],
            'contrasena'        => ['required','string','min:6'],
            'tipo_documento'    => ['required','in:CC,TI,CE,PAS'],   // <-- obligatorio
            'numero_documento'  => ['required','string','max:50'],   // <-- si lo quieres obligatorio
            'genero'            => ['nullable','in:Masculino,Femenino,Otro'],
            'fecha_nacimiento'  => ['nullable','date'],
            'id_rol'            => ['nullable','integer','in:1,2,3'],
            'estatus'           => ['nullable','in:Activo,Inactivo'],
        ]);

        $nombre           = $request->nombre;
        $apellido         = $request->apellido;
        $email            = $request->email;
        $contrasenaPlano  = $request->contrasena;
        $fechaNacimiento  = $request->fecha_nacimiento;
        $idRol            = $request->id_rol;
        $estatus          = $request->estatus ?? 'Activo';
        $tipoDocumento    = $request->tipo_documento;
        $numeroDocumento  = $request->numero_documento;
        $genero           = $request->genero;

        if (User::where('email', $email)->exists() || Usuario::where('email', $email)->exists()) {
            return back()->withErrors(['email' => 'El correo ya existe.'])->withInput();
        }

        return DB::transaction(function () use (
            $nombre, $apellido, $email, $contrasenaPlano, $fechaNacimiento, $idRol, $estatus,
            $tipoDocumento, $numeroDocumento, $genero
        ) {
            $hash = Hash::make($contrasenaPlano);

            $user = User::create([
                'name'     => trim("$nombre $apellido"),
                'email'    => $email,
                'password' => $hash,
            ]);

            Usuario::create([
                'nombre'           => $nombre,
                'apellido'         => $apellido,
                'email'            => $email,
                'contrasena'       => $hash,           // mismo hash
                'fecha_nacimiento' => $fechaNacimiento,
                'id_rol'           => $idRol,
                'estatus'          => $estatus,
                'user_id'          => $user->id,
                'tipo_documento'   => $tipoDocumento,
                'numero_documento' => $numeroDocumento,
                'genero'           => $genero,
            ]);

            return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente.');
        });
    }


    /**
     * Editar usuario (si usas vista)
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Actualizar usuario y sincronizar hash
     */

    public function update(Request $request, Usuario $usuario)
    {
        // Normalizar inputs (soporta MAYÚSCULAS del form viejo)
        $nombre           = $request->input('nombre', $request->input('NOMBRE'));
        $apellido         = $request->input('apellido', $request->input('APELLIDO'));
        $email            = $request->input('email', $request->input('EMAIL'));
        $contrasenaPlano  = $request->input('contrasena', $request->input('CONTRASENA'));
        $fechaNacimiento  = $request->input('fecha_nacimiento', $request->input('FECHA_NACIMIENTO'));
        $idRol            = $request->input('id_rol', $request->input('ROLES_FK')); // opcional
        $estatus          = $request->input('estatus', $request->input('ESTATUS')); // opcional

        // Validaciones
        $request->validate([
            // email requerido y único en ambas tablas (ignorando el propio)
            'email' => ['nullable'],
            'EMAIL' => ['nullable'],
        ]);
        $request->validate([
            'fake' => ['nullable'], // evita conflictos si usas los campos normalizados
        ]);
        // Reglas manuales de unicidad (claras y sin ambigüedades)
        if (
            \App\Models\User::where('email', $email)->where('id', '!=', $usuario->user_id)->exists() ||
            \App\Models\Usuario::where('email', $email)->where('id_usuario', '!=', $usuario->id_usuario)->exists()
        ) {
            return back()->withErrors(['email' => 'El email ya existe en otro registro.'])->withInput();
        }

        return \DB::transaction(function () use ($usuario, $nombre, $apellido, $email, $contrasenaPlano, $fechaNacimiento, $idRol, $estatus) {
            // Buscar o crear User enlazado
            $user = $usuario->user;
            if (!$user) {
                $hashParaNuevo = $contrasenaPlano
                    ? \Hash::make($contrasenaPlano)
                    : ($usuario->contrasena && str_starts_with($usuario->contrasena, '$2y$')
                        ? $usuario->contrasena
                        : \Hash::make(Str::random(16)));

                $user = \App\Models\User::create([
                    'name'     => trim(($nombre ?? '').' '.($apellido ?? '')),
                    'email'    => $email,
                    'password' => $hashParaNuevo,
                ]);

                // Enlazar
                $usuario->user_id    = $user->id;
                $usuario->contrasena = $hashParaNuevo; // misma contraseña
            }

            // Si vino nueva contraseña, un solo hash y a ambas tablas
            if (!empty($contrasenaPlano)) {
                $hash = \Hash::make($contrasenaPlano);
                $user->password      = $hash;
                $usuario->contrasena = $hash;
            } else {
                // Si no cambiaste contraseña, asegura sincronía copiando la de users (hash)
                $usuario->contrasena = $user->password;
            }

            // Actualizar User
            $user->name  = trim(($nombre ?? '').' '.($apellido ?? ''));
            $user->email = $email;
            $user->save();

            // Actualizar Usuario
            $usuario->nombre           = $nombre;
            $usuario->apellido         = $apellido;
            $usuario->email            = $email;
            $usuario->fecha_nacimiento = $fechaNacimiento;

            // Rol solo si vino (opcional)
            if (!is_null($idRol) && $idRol !== '') {
                $usuario->id_rol = (int) $idRol;
            }

            // Estatus solo si vino (opcional)
            if (!is_null($estatus) && $estatus !== '') {
                $usuario->estatus = $estatus;
            }

            $usuario->save();

            return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
        });
    }


    /**
     * Eliminar usuario y su User asociado
     */
    public function destroy(Usuario $usuario)
    {
        return DB::transaction(function () use ($usuario) {
            if ($usuario->user) {
                $usuario->user->delete(); // elimina también de tabla users
            }
            $usuario->delete();

            return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
        });
    }

    //FUNCIONES EXTRAS
    public function buscarPorDocumento(Request $request)
    {
        $doc = $request->query('numero_documento');
        if (!$doc) {
            return response()->json(['found' => false]);
        }

        $usuario = \App\Models\Usuario::select('id_usuario','nombre','apellido','numero_documento','email')
            ->where('numero_documento', $doc)
            ->first();

        return response()->json([
            'found'   => (bool) $usuario,
            'usuario' => $usuario,
        ]);
    }

}
