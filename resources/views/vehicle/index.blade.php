<x-admin-layout>
    <div class="mt-3 mb-4 border border-gray-300 shadow-lg rounded-lg bg-gray-200 dark:bg-slate-800 p-6">
        <div class="p-4">
            <form action="{{ route('vehicles.index') }}" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Campo Placa do Veículo -->
                    <div class="col-span-1">
                        <label for="vehicle" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Placa do Veículo</label>
                        <input type="text" id="vehicle" name="vehicle" value="{{ request('vehicle') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 uppercase text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Ex: ABC1234">
                    </div>

                    <!-- Filtro Tipo de Veículo -->
                    <div class="col-span-1">
                        <label for="type_vehicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo do Veículo</label>
                        <select id="type_vehicle" name="type_vehicle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione o Tipo</option>
                            @foreach ($type_vehicles as $type_vehicle)
                                <option value="{{ $type_vehicle->id }}" {{ request('type_vehicle') == $type_vehicle->id ? 'selected' : '' }}>{{ $type_vehicle->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro Situação do Veículo -->
                    <div class="col-span-1">
                        <label for="situation_vehicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Situação do Veículo</label>
                        <select id="situation_vehicle" name="situation_vehicle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecione a Situação</option>
                            @foreach ($situation_vehicle as $situation)
                                <option value="{{ $situation->id }}" {{ request('situation_vehicle') == $situation->id ? 'selected' : '' }}>{{ $situation->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="col-span-1 flex items-center mt-2 justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded-md hover:bg-blue-600 transition-colors duration-300">
                            <i class="fa-solid fa-magnifying-glass"></i> Pesquisar
                        </button>

                        <a href="javascript:void(0);" onclick="clearFilters()" class="bg-yellow-400 text-white px-4 py-2 mt-3 rounded-md hover:bg-gray-600">
                            <i class="fa-solid fa-eraser"></i> Limpar
                        </a>

                        <script>
                            function clearFilters() {
                                document.querySelector("form").reset();  // Limpa os campos do formulário
                                window.location.href = "{{ route('vehicles.index') }}";  // Redireciona para a rota limpa
                            }
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabela de Veículos -->
    <div class="col-span-2 flex items-center mt-2 mb-2 justify-between">
        <div class="bg-white shadow rounded-md overflow-hidden my-6 w-full">
            <div class="flex justify-start space-x-4 mb-4">
                <a href="{{ route('vehicles.create') }}" class="bg-blue-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400">
                    <i class="fas fa-plus" aria-label="Novo veículo"></i> Novo Veículo
                </a>

                <a href="{{ url('veiculo-gerar_pdf?' . request()->getQueryString()) }}" class="bg-red-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-red-600 focus:ring-2 focus:ring-red-400">
                    <i class="fa-solid fa-file-pdf fa-2x" aria-label="Gerar PDF"></i> Gerar PDF
                </a>

                <a href="{{ url('gerar_svg?' . request()->getQueryString()) }}" class="bg-green-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-green-600 focus:ring-2 focus:ring-green-400">
                    <i class="fas fa-file-excel fa-2x" aria-label="Gerar Excel"></i> Gerar Excel
                </a>
            </div>

            <x-alert/>

              <!-- Tabela -->
              <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 rounded-md">
                    <thead>
                        <tr class="bg-gray-700 text-white text-sm">
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Batalhão</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Tipo</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Situação</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Marca</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Modelo</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Placa</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Ano</th>
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Prefixo</th>
                        {{-- <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Patrimônio</th> --}}
                        <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr class="hover:bg-gray-200">
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->subCommand->slug ?? '-' }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->typeVehicle->type ?? '-' }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->situationVehicle->name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->brand }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->model }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->plate }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->year }}</td>
                            <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->prefix }}</td>
                            {{-- <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $vehicle->asset_number }}</td> --}}
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit" aria-label="Editar"></i>
                                </a>
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="text-green-500 hover:text-green-700 mr-2">
                                    <i class="fa-regular fa-folder-open" aria-label="Visualizar"></i>
                                </a>  

                                <form id="formDeleteVehicle{{ $vehicle->id }}" action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="confirmDelete(event, 'formDeleteVehicle{{ $vehicle->id }}')">
                                        <i class="fas fa-trash-alt" aria-label="Deletar"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-2 text-center text-gray-500">Nenhum veículo cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
  
    </div>

    </div>
    <!-- Paginacao abaixo da tabela -->
<div class="mt-6 flex justify-center">
    {{ $vehicles->onEachSide(3)->links() }}
</div>
</div>


</x-admin-layout>
