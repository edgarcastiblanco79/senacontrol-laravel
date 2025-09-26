<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="pb-4">
                    <h1 class="text-2xl font-bold mb-6">Lista de Usuarios</h1>
                    <a href="{{ route('usuario.create') }}"
                       class="inline-flex items-center px-3 py-2 bg-emerald-600 text-white text-sm font-medium rounded hover:bg-emerald-700">
                        + Crear Usuario
                    </a>
                </div>

                <table id="usuarios" class="min-w-full border border-gray-300 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Fecha de Nacimiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Estatus</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($usuarios as $usu)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $usu->id_usuario }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $usu->nombre }} {{ $usu->apellido }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $usu->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @switch($usu->id_rol)
                                        @case(1)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Administrador
                                            </span>
                                            @break
                                        @case(2)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Instructor
                                            </span>
                                            @break
                                        @case(3)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Estudiante
                                            </span>
                                            @break
                                        @default
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Sin rol
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $usu->fecha_nacimiento?->format('Y-m-d') ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($usu->estatus === 'Activo')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-2">
                                    {{-- Editar --}}
                                    <a href="{{ route('usuario.edit', $usu->id_usuario) }}"
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536M16.5 3.964a2.5 2.5 0 113.536 3.536L7.5 20.036H3v-4.5L16.5 3.964z"/>
                                        </svg>
                                        Editar
                                    </a>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('usuario.destroy', $usu->id_usuario) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M4 7h16M9 3h6a1 1 0 011 1v1H8V4a1 1 0 011-1z"/>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- DataTables (CDN) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(function () {
            $('#usuarios').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
</x-app-layout>
