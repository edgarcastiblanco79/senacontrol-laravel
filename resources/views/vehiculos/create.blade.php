<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Vehículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow sm:rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-6 text-center">Nuevo Vehículo</h1>

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc ml-6">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehiculos.store') }}" method="POST" class="max-w-xl mx-auto">
                    @csrf

                    {{-- Placa --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Placa *</label>
                        <input type="text" name="placa" value="{{ old('placa') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                    </div>

                    {{-- Número de chasis --}}
                    <div class="mb-4">
                        <label class="block text-gray-700">Número de chasis</label>
                        <input type="text" name="numero_chasis" value="{{ old('numero_chasis') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Tipo / Marca / Modelo --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700">Tipo</label>
                            <input type="text" name="tipo" value="{{ old('tipo') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   placeholder="Carro, Moto...">
                        </div>
                        <div>
                            <label class="block text-gray-700">Marca</label>
                            <input type="text" name="marca" value="{{ old('marca') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block text-gray-700">Modelo</label>
                            <input type="text" name="modelo" value="{{ old('modelo') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        </div>
                    </div>

                    {{-- Color --}}
                    <div class="mb-4 mt-4">
                        <label class="block text-gray-700">Color</label>
                        <input type="text" name="color" value="{{ old('color') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    </div>

                    {{-- Propietario: búsqueda por documento --}}
                    <div class="mb-6">
                        <label for="numero_documento_prop" class="block text-gray-700">
                            Propietario (buscar por número de documento)
                        </label>

                        <div class="flex gap-2">
                            <input type="text" id="numero_documento_prop" placeholder="Ingrese documento (ej: 1001001001)"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   value="{{ old('numero_documento_prop') }}">
                            <button type="button" id="btnBuscarProp"
                                    class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded">
                                Buscar
                            </button>
                        </div>

                        <div id="resultadoProp" class="mt-2 text-sm text-gray-700"></div>

                        {{-- hidden que se enviará con el formulario --}}
                        <input type="hidden" name="id_usuario" id="id_usuario" value="{{ old('id_usuario') }}">
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('vehiculos.index') }}"
                           class="px-5 py-2.5 text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm">
                            Guardar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- JS de búsqueda --}}
    <script>
    (function () {
        const inputDoc = document.getElementById('numero_documento_prop');
        const btnBuscar = document.getElementById('btnBuscarProp');
        const salida = document.getElementById('resultadoProp');
        const inputIdUsuario = document.getElementById('id_usuario');

        async function buscar() {
            const doc = (inputDoc.value || '').trim();
            salida.textContent = 'Buscando...';
            inputIdUsuario.value = '';

            if (!doc) {
                salida.textContent = 'Ingresa un número de documento.';
                return;
            }

            try {
                const url = `{{ route('usuarios.buscarDocumento') }}?numero_documento=${encodeURIComponent(doc)}`;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const data = await res.json();

                if (data.found && data.usuario) {
                    inputIdUsuario.value = data.usuario.id_usuario;
                    salida.innerHTML = `
                        <span class="text-emerald-700 font-medium">Encontrado:</span>
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

        btnBuscar.addEventListener('click', buscar);
        inputDoc.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); buscar(); }
        });
    })();
    </script>
</x-app-layout>
