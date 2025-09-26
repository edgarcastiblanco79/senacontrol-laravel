<?php

namespace App\Http\Controllers\Vehiculo;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    public function index()
    {
        // sin paginación y sin orden (los trae tal cual)
        $vehiculos = Vehiculo::with('usuario')->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        // Para el select de usuarios (propietario)
        $usuarios = Usuario::select('id_usuario', 'nombre', 'apellido')->get();
        return view('vehiculos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa'          => ['required','string','max:20','unique:vehiculos,placa'],
            'numero_chasis'  => ['nullable','string','max:100'],
            'tipo'           => ['nullable','string','max:50'],
            'marca'          => ['nullable','string','max:50'],
            'modelo'         => ['nullable','string','max:50'],
            'color'          => ['nullable','string','max:30'],
            'id_usuario'     => ['nullable','integer','exists:usuario,id_usuario'],
        ]);

        Vehiculo::create($request->only([
            'placa','numero_chasis','tipo','marca','modelo','color','id_usuario'
        ]));

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
    }

    public function edit(Vehiculo $vehiculo)
    {
        $vehiculo->load('usuario'); // para mostrar el propietario actual
        return view('vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'placa'         => ['required','string','max:20', Rule::unique('vehiculos','placa')->ignore($vehiculo->id_vehiculo, 'id_vehiculo')],
            'numero_chasis' => ['nullable','string','max:100'],
            'tipo'          => ['nullable','string','max:50'],
            'marca'         => ['nullable','string','max:50'],
            'modelo'        => ['nullable','string','max:50'],
            'color'         => ['nullable','string','max:30'],
            'id_usuario'    => ['nullable','integer','exists:usuario,id_usuario'],
        ]);

        // Campos base
        $vehiculo->placa         = $request->placa;
        $vehiculo->numero_chasis = $request->numero_chasis;
        $vehiculo->tipo          = $request->tipo;
        $vehiculo->marca         = $request->marca;
        $vehiculo->modelo        = $request->modelo;
        $vehiculo->color         = $request->color;

        // Mantener propietario si no vino (hidden queda con el actual)
        if ($request->exists('id_usuario')) { // existe en el request
            $vehiculo->id_usuario = $request->id_usuario !== null && $request->id_usuario !== ''
                ? (int)$request->id_usuario
                : null; // si apretó "Quitar" lo dejamos null
        }

        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }


    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
    }
}
