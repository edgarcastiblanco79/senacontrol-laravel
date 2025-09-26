<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehículos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="mb-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Lista de Vehículos</h1>
                    <a href="{{ route('vehiculos.create') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Crear Vehículo
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table id="vehiculos" class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Placa</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Tipo</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Marca</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Modelo</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Color</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Chasis</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Propietario</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Numero Documento</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($vehiculos as $v)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $v->id_vehiculo }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->placa }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->tipo }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->marca }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->modelo }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->color }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $v->numero_chasis }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        @if($v->usuario)
                                            {{ $v->usuario->nombre }} {{ $v->usuario->apellido }}
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-sm">
                                        @if($v->usuario)
                                            {{ $v->usuario->numero_documento }}
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-sm flex gap-2">
                                        <a href="{{ route('vehiculos.edit', $v) }}"
                                           class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Editar
                                        </a>
                                        <form action="{{ route('vehiculos.destroy', $v) }}" method="POST"
                                              onsubmit="return confirm('¿Seguro que quieres eliminar este vehículo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                        No hay vehículos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

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
            $('#vehiculos').DataTable({
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
