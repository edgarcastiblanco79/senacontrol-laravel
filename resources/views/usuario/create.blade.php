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

                <form action="{{ route('usuario.store') }}" method="POST" class="max-w-md mx-auto">
                    @csrf

                    <!-- Nombre -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="NOMBRE" id="NOMBRE"
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

                    <!-- Contraseña -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="CONTRASENA" id="CONTRASENA"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                               border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required />
                        <label for="CONTRASENA"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Contraseña
                        </label>
                    </div>

                    <!-- Categoría -->
                    <div class="relative z-0 w-full mb-5 group">
                        <select name="CATEGORIA" id="CATEGORIA"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 
                                border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="COMPUTADOR">Computador</option>
                            <option value="VEHICULO">Vehiculo</option>
                            <option value="MOTO">Moto</option>
                        </select>
                        <label for="CATEGORIA"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Categoría
                        </label>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO"
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
                                border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">-- Seleccione un Rol --</option>
                            <option value="1">Administrador</option>
                            <option value="2">Instructor</option>
                            <option value="3">Estudiante</option>
                            <option value="4">Otros</option>
                        </select>
                        <label for="ROLES_FK"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform 
                               -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 
                               peer-focus:scale-75 peer-focus:-translate-y-6">
                            Rol
                        </label>
                    </div>

                    <!-- Botón Guardar -->
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                            focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Guardar
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
