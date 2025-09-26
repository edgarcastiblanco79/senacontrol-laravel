<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="mb-6 rounded border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usuario.update', $usuario->id_usuario) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombre" name="nombre"
                               value="{{ old('nombre', $usuario->nombre) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                    </div>

                    {{-- Apellido (si existe en tu tabla) --}}
                    <div>
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" id="apellido" name="apellido"
                               value="{{ old('apellido', $usuario->apellido) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $usuario->email) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                    </div>

                    {{-- Contraseña (opcional) --}}
                    <div>
                        <label for="contrasena" class="block text-sm font-medium text-gray-700">
                            Contraseña (déjala en blanco si no deseas cambiarla)
                        </label>
                        <input type="password" id="contrasena" name="contrasena"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Fecha de nacimiento --}}
                    <div>
                        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                               value="{{ old('fecha_nacimiento', optional($usuario->fecha_nacimiento)->format('Y-m-d')) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Rol (opcional) --}}
                    <div>
                    <label for="id_rol" class="block text-sm font-medium text-gray-700">Rol</label>
                    <select id="id_rol" name="id_rol"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">— Sin rol —</option>
                        <option value="1" {{ (string)old('id_rol', $usuario->id_rol) === '1' ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ (string)old('id_rol', $usuario->id_rol) === '2' ? 'selected' : '' }}>Instructor</option>
                        <option value="3" {{ (string)old('id_rol', $usuario->id_rol) === '3' ? 'selected' : '' }}>Estudiante</option>
                    </select>
                    </div>

                    {{-- Estatus (opcional) --}}
                    <div class="mb-4">
                        <label for="estatus" class="block text-sm font-medium text-gray-700">Estatus</label>
                        @php
                            // Normaliza el valor actual: capitaliza la primera letra y el resto en minúsculas
                            $estatusActual = ucfirst(strtolower(old('estatus', $usuario->estatus ?? '')));
                        @endphp
                        <select id="estatus" name="estatus"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">— Seleccione —</option>
                            <option value="Activo"   {{ $estatusActual === 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $estatusActual === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="inline-flex items-center rounded bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Actualizar
                        </button>

                        {{-- Botón Cancelar --}}
                        <a href="{{ route('usuario.index') }}"
                           class="inline-flex items-center rounded border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
