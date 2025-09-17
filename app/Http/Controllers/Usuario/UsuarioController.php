<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Role;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Usuario::all();
        return view ('usuario.index',compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'NOMBRE' => 'required|string|max:100',
        'EMAIL' => 'required|email|unique:usuario,EMAIL',
        'CONTRASENA' => 'required|string|min:6',
        'CATEGORIA' => 'required|string',
        'FECHA_NACIMIENTO' => 'required|date',
        'ROLES_FK' => 'required|integer|exists:roles,ID_ROL', // valida que exista el rol
        ]);

        $usuario = Usuario::create([
            'NOMBRE' => $request->NOMBRE,
            'EMAIL' => $request->EMAIL,
            'CONTRASENA' => bcrypt($request->CONTRASENA), //encriptada
            'CATEGORIA' => $request->CATEGORIA,
            'FECHA_NACIMIENTO' => $request->FECHA_NACIMIENTO,
            'ESTATUS' => 'ACTIVO', // valor predefinido, primera creacion, obviamente ACTIVO
            'ROLES_FK' => $request->ROLES_FK, // Rol defininido en el formulario
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Usuario $usuario)
    {
        // Validar los campos
        $request->validate([
            'NOMBRE' => 'required|string|max:255',
            'EMAIL' => 'required|email|max:255',
            'FECHA_NACIMIENTO' => 'required|date',
            'CATEGORIA' => 'required|string',
            'ROLES_FK' => 'required|integer',
        ]);

        // Actualizar datos
        $usuario->NOMBRE = $request->NOMBRE;
        $usuario->EMAIL = $request->EMAIL;

        // Solo actualizar contraseña si viene
        if (!empty($request->CONTRASENA)) {
            $usuario->CONTRASENA = bcrypt($request->CONTRASENA);
        }

        $usuario->CATEGORIA = $request->CATEGORIA;
        $usuario->FECHA_NACIMIENTO = $request->FECHA_NACIMIENTO;
        $usuario->ROLES_FK = $request->ROLES_FK;

        $usuario->save();

        // Redirigir al index con mensaje
        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
