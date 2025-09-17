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

                <form action="{{ route('usuario.update', $usuario->ID_USUARIO) }}" method="POST" class="max-w-md mx-auto">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="NOMBRE" id="NOMBRE" 
                               value="{{ old('NOMBRE', $usuario->NOMBRE) }}"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                               border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required />
                        <label for="NOMBRE"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Nombre
                        </label>
                    </div>

                    <!-- Email -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="EMAIL" id="EMAIL" 
                               value="{{ old('EMAIL', $usuario->EMAIL) }}"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                               border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required />
                        <label for="EMAIL"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Email
                        </label>
                    </div>

                    <!-- Contraseña (opcional) -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="CONTRASENA" id="CONTRASENA"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                               border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " />
                        <label for="CONTRASENA"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Contraseña (déjala en blanco si no deseas cambiarla)
                        </label>
                    </div>

                    <!-- Categoría -->
                    <div class="relative z-0 w-full mb-5 group">
                        <select name="CATEGORIA" id="CATEGORIA"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                                border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="COMPUTADOR" {{ $usuario->CATEGORIA == 'COMPUTADOR' ? 'selected' : '' }}>Computador</option>
                            <option value="VEHICULO" {{ $usuario->CATEGORIA == 'VEHICULO' ? 'selected' : '' }}>Vehiculo</option>
                            <option value="MOTO" {{ $usuario->CATEGORIA == 'MOTO' ? 'selected' : '' }}>Moto</option>
                        </select>
                        <label for="CATEGORIA"
                               class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] 
                               peer-focus:text-blue-600">
                            Categoría
                        </label>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" 
                            value="{{ old('FECHA_NACIMIENTO', \Carbon\Carbon::parse($usuario->FECHA_NACIMIENTO)->format('Y-m-d')) }}"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                            border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="FECHA_NACIMIENTO"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                            -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                            peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                            peer-focus:scale-75 peer-focus:-translate-y-6">
                            Fecha de Nacimiento
                        </label>
                    </div>


                    <!-- Rol -->
                    <div class="relative z-0 w-full mb-5 group">
                        <select name="ROLES_FK" id="ROLES_FK"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                                border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">-- Seleccione un Rol --</option>
                            <option value="1" {{ $usuario->ROLES_FK == 1 ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ $usuario->ROLES_FK == 2 ? 'selected' : '' }}>Estudiante</option>
                            <option value="3" {{ $usuario->ROLES_FK == 3 ? 'selected' : '' }}>Instructor</option>
                            <option value="4" {{ $usuario->ROLES_FK == 4 ? 'selected' : '' }}>Otros</option>
                        </select>
                        <label for="ROLES_FK"
                               class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] 
                               peer-focus:text-blue-600">
                            Rol
                        </label>
                    </div>

                    <!-- Botón Actualizar -->
                    <button type="submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none 
                            focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Actualizar
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
