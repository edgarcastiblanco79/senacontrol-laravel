<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Nuevo Usuario</h1>

                {{-- Mostrar errores de validación --}}
                @if ($errors->any())
                    <div class="mb-6 rounded border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usuario.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Nombre --}}
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombre" name="nombre"
                               value="{{ old('nombre') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                    </div>

                    {{-- Apellido --}}
                    <div>
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" id="apellido" name="apellido"
                               value="{{ old('apellido') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                    </div>

                    {{-- Contraseña --}}
                    <div>
                        <label for="contrasena" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="contrasena" name="contrasena"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                    </div>

                    {{-- Fecha de Nacimiento --}}
                    <div>
                        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                               value="{{ old('fecha_nacimiento') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Tipo Documento --}}
                    <div>
                        <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                        <select id="tipo_documento" name="tipo_documento"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">— Seleccione —</option>
                            <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula</option>
                            <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                            <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula Extranjera</option>
                            <option value="PAS" {{ old('tipo_documento') == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                    </div>

                    {{-- Número de Documento --}}
                    <div>
                        <label for="numero_documento" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                        <input type="text" id="numero_documento" name="numero_documento"
                               value="{{ old('numero_documento') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Género --}}
                    <div>
                        <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                        <select id="genero" name="genero"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">— Seleccione un Genero —</option>
                            <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>

                    {{-- Rol --}}
                    <div class="mb-4">
                        <label for="id_rol" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="id_rol" name="id_rol"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500">
                            <option value="">— Seleccione un Rol —</option>
                            <option value="1" {{ old('id_rol', $usuario->id_rol ?? '') == 1 ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ old('id_rol', $usuario->id_rol ?? '') == 2 ? 'selected' : '' }}>Instructor</option>
                            <option value="3" {{ old('id_rol', $usuario->id_rol ?? '') == 3 ? 'selected' : '' }}>Estudiante</option>
                        </select>
                    </div>

                    {{-- Estatus --}}
                    <div>
                        <label for="estatus" class="block text-sm font-medium text-gray-700">Estatus</label>
                        <select id="estatus" name="estatus"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="Activo" {{ old('estatus') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estatus') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="inline-flex items-center rounded bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Guardar
                        </button>

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
