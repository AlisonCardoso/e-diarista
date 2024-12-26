<x-admin-layout>
    <div class="mt-3 mb-4 border border-gray-300 shadow-lg rounded-lg bg-gray-200 dark:bg-slate-800 p-6">
        <div class="p-4">
            <form action="{{ route('service_orders.index') }}" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Campo Placa do Veículo -->
                    <div class="col-span-1">
                        <label for="vehicle" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Placa do Veículo</label>
                        <input type="text" id="vehicle" name="vehicle" value="{{ request('vehicle') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 uppercase text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Ex: ABC1234">
                    </div>

                    <!-- Campo Oficina -->
                    <div class="col-span-1">
                        <label for="workshop" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Oficina</label>
                        <input type="text" id="workshop" name="workshop" value="{{ request('workshop') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 uppercase text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o nome parcial da oficina">
                    </div>

                    <!-- Campo Produto -->
                    <div class="col-span-1">
                        <label for="product" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Produto</label>
                        <select id="product" name="product" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione um produto ou serviço</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="type_vehicle" class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">TIPO DO VEÍCULO</label>
                        <select id="type_vehicle" name="type_vehicle"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>TIPO DE VEÍCULO</option>
                            @foreach ($type_vehicles as $type_vehicle)
                                <option value="{{ $type_vehicle->id }}" {{ request('type_vehicle') == $type_vehicle->id ? 'selected' : '' }}>{{ $type_vehicle->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="situation" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="situation" name="situation"
                                class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione um Status</option>
                            @foreach ($situations as $situation)
                                <option value="{{ $situation->id }}" {{ request('situation') == $situation->id ? 'selected' : '' }}>{{ $situation->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="data_inicio" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Data Início</label>
                        <input type="date" id="data_inicio" name="data_inicio"
                               value="{{ request('data_inicio') ? \Carbon\Carbon::parse(request('data_inicio'))->format('Y-m-d') : '' }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Campo Data Fim -->
                    <div class="col-span-1">
                        <label for="data_fim" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Data Fim</label>
                        <input type="date" id="data_fim" name="data_fim"
                               value="{{ request('data_fim') ? \Carbon\Carbon::parse(request('data_fim'))->format('Y-m-d') : '' }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

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
                                window.location.href = "{{ route('service_orders.index') }}";  // Redireciona para a rota limpa
                            }
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-span-2 flex items-center mt-2 mb-2 justify-between">
        <div class="bg-white shadow rounded-md overflow-hidden my-6">
            <div class="flex justify-start space-x-4 mb-4">
                <a href="{{ route('service_orders.create') }}" class="bg-blue-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400">
                    <i class="fas fa-plus" aria-label="Nova ordem de serviço"></i> Nova ordem de serviço
                </a>

                <a href="{{ url('gerar_pdf?' . request()->getQueryString()) }}" class="bg-red-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-red-600 focus:ring-2 focus:ring-red-400">
                    <i class="fa-solid fa-file-pdf fa-2x" aria-label="Gerar PDF"></i> Gerar PDF
                </a>
                
                <a href="{{ url('gerar_svg?' . request()->getQueryString()) }}" class="bg-green-500 text-white px-4 py-2 ms-2 mt-2 mb-2 rounded-md hover:bg-green-600 focus:ring-2 focus:ring-green-400">
                    <i class="fas fa-file-excel fa-2x" aria-label="Gerar Excel"></i> Gerar Excel
                </a>
                
            </div>

            <x-alert/>

            <h2 class="text-xl font-bold mt-6 mb-6 ms-6">Ordens de Serviço Cadastradas</h2>

            <!-- Tabela -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 rounded-md">
                    <thead>
                        <tr class="bg-gray-700 text-white text-sm">
                            <th class="py-3 px-5">ID</th>
                            <th class="py-3 px-5">Veículo</th>
                            <th class="py-3 px-5">Tipo</th>
                            <th class="py-3 px-5">Oficina</th>
                            <th class="py-3 px-5">Situação</th>
                            <th class="py-3 px-5">Data do Serviço</th>
                            <th class="py-3 px-5">Mão de Obra</th>
                            <th class="py-3 px-5">Valor Produtos</th>
                            <th class="py-3 px-5">Total Orçamento</th>
                            <th class="py-3 px-5">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceOrders as $serviceOrder)
                            <tr class="hover:bg-indigo-100">
                                <td class="px-4 py-2 border-b">{{ $serviceOrder->id }}</td>
                                <td class="px-4 py-2 border-b">{{ $serviceOrder->vehicle->plate ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border-b">
                                    @if ($serviceOrder->vehicle && $serviceOrder->vehicle->typeVehicle)
                                        {{ $serviceOrder->vehicle->typeVehicle->type ?? 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-4 py-2 border-b">{{ $serviceOrder->workshop->razao_social ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ route('service_orders.change-situation', ['serviceOrder' => $serviceOrder->id]) }}">
                                        <span class="inline-flex items-center rounded-md bg-{{ $serviceOrder->situation->color }} px-2 py-1 text-xs font-medium text-gray-200 ring-1 ring-inset ring-red-600/10">
                                            {{ $serviceOrder->situation->description }}
                                        </span>
                                    </a>
                                </td>
                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($serviceOrder->service_date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border-b">R$ {{ number_format($serviceOrder->calculateLaborTotal(), 2, ',', '.') }}</td>
                                <td class="px-4 py-2 border-b">R$ {{ number_format($serviceOrder->calculateProductTotal(), 2, ',', '.') }}</td>
                                <td class="px-4 py-2 border-b">R$ {{ number_format($serviceOrder->calculateTotal(), 2, ',', '.') }}</td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ route('service_orders.edit', $serviceOrder) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                        <i class="fas fa-edit" aria-label="Editar"></i>
                                    </a>
                                    <a href="{{ route('service_orders.show', $serviceOrder) }}" class="text-green-500 hover:text-green-700 mr-2">
                                        <i class="fa-regular fa-folder-open" aria-label="Visualizar"></i>
                                    </a>
                                    <form id="formDeleteServiceOrder{{ $serviceOrder->id }}" action="{{ route('service_orders.destroy', $serviceOrder) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="confirmDelete(event, 'formDeleteServiceOrder{{ $serviceOrder->id }}')">
                                            <i class="fas fa-trash-alt" aria-label="Deletar"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $serviceOrders->onEachSide(3)->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
