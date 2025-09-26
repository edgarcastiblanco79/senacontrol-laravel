<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Vehículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow sm:rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-6 text-center">Editar Vehículo</h1>

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc ml-6">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" class="max-w-xl mx-auto">
                    @csrf
                    @method('PUT')

                    {{-- Placa --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Placa *</label>
                        <input type="text" id="placa" name="placa" value="{{ old('placa', $vehiculo->placa) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                    </div>

                    {{-- Número de chasis --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Número de chasis</label>
                        <input type="text" id="numero_chasis" name="numero_chasis" value="{{ old('numero_chasis', $vehiculo->numero_chasis) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Tipo / Marca / Modelo --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700">Tipo</label>
                            <input type="text" id="tipo" name="tipo" value="{{ old('tipo', $vehiculo->tipo) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block text-gray-700">Marca</label>
                            <input type="text" id="marca" name="marca" value="{{ old('marca', $vehiculo->marca) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block text-gray-700">Modelo</label>
                            <input type="text" id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                    </div>

                    {{-- Color --}}
                    <div class="mb-4 mt-4">
                        <label class="block text-gray-700">Color</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $vehiculo->color) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Propietario actual (solo lectura) --}}
                    <div class="mb-2">
                        <label class="block text-gray-700 mb-1">Propietario actual</label>
                        <input type="text"
                               class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-800"
                               value="{{ $vehiculo->usuario ? ($vehiculo->usuario->nombre.' '.$vehiculo->usuario->apellido.' ('.$vehiculo->usuario->email.')') : '— Sin asignar —' }}"
                               readonly
                               aria-readonly="true">
                        {{-- hidden con el dueño que se enviará; inicia con el actual --}}
                        <input type="hidden" id="id_usuario" name="id_usuario" id="id_usuario"
                               value="{{ old('id_usuario', $vehiculo->id_usuario) }}">
                    </div>

                    {{-- Cambio de propietario (opcional) por documento --}}
                    <div class="mb-6">
                        <label for="numero_documento_prop" class="block text-gray-700 mb-1">
                            Cambiar propietario (opcional) — Buscar por número de documento
                        </label>

                        <div class="flex gap-2">
                            <input type="text" id="numero_documento_prop"
                                   placeholder="Ingrese documento (ej: 1001001001)"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <button type="button" id="btnBuscarProp"
                                    class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded">
                                Buscar
                            </button>
                            <button type="button" id="btnQuitarProp"
                                    class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">
                                Quitar
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            Si dejas el documento vacío y no presionas “Buscar”, el propietario se mantiene igual.
                        </p>

                        <div id="resultadoProp" class="mt-2 text-sm text-gray-700"></div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex justify-between">
                        <a href="{{ route('vehiculos.index') }}"
                           class="px-5 py-2.5 text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-5 py-2.5 text-white bg-green-600 hover:bg-green-700 rounded-lg text-sm">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JS: búsqueda por documento para cambiar propietario --}}
    <script>
    (function () {
        const inputDoc = document.getElementById('numero_documento_prop');
        const btnBuscar = document.getElementById('btnBuscarProp');
        const btnQuitar = document.getElementById('btnQuitarProp');
        const salida = document.getElementById('resultadoProp');
        const inputIdUsuario = document.getElementById('id_usuario');

        async function buscar() {
            const doc = (inputDoc.value || '').trim();
            salida.textContent = 'Buscando...';

            if (!doc) {
                salida.textContent = 'Ingresa un número de documento.';
                return;
            }

            try {
                const url = `{{ route('usuarios.buscarDocumento') }}?numero_documento=${encodeURIComponent(doc)}`;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const data = await res.json();

                if (data.found && data.usuario) {
                    // Sobrescribe el id_usuario solo si encuentra un usuario
                    inputIdUsuario.value = data.usuario.id_usuario;
                    salida.innerHTML = `
                        <span class="text-emerald-700 font-medium">Nuevo propietario seleccionado:</span>
                        ${data.usuario.nombre} ${data.usuario.apellido}
                        <span class="text-gray-500">(${data.usuario.email})</span>
                    `;
                } else {
                    salida.innerHTML = `<span class="text-red-700">No se encontró un usuario con ese documento.</span>`;
                }
            } catch (e) {
                console.error(e);
                salida.innerHTML = `<span class="text-red-700">Error buscando el usuario.</span>`;
            }
        }

        function quitar() {
            inputIdUsuario.value = ''; // quedará sin asignar
            salida.innerHTML = `<span class="text-gray-500">— Propietario quedará sin asignar —</span>`;
            inputDoc.value = '';
        }

        btnBuscar.addEventListener('click', buscar);
        btnQuitar.addEventListener('click', quitar);
        inputDoc.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); buscar(); }
        });
    })();
    </script>
</x-app-layout>
