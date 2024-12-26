<x-admin-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-4xl px-4 py-8 mx-auto lg:py-16">
  
            <h2 class="mb-4 text-xl font-bold uppercase text-gray-900 dark:text-white">Editar Ordem de Serviço</h2>

            <x-alert/>

            <form action="{{ isset($serviceOrder) ? route('service_orders.update', $serviceOrder) : route('service_orders.store') }}" method="POST">
                @csrf
                @if (isset($serviceOrder))
                    @method('PUT')
                @endif
                <div>
                    <x-text-input id="user_id" name="user_id" type="hidden" class="mt-1 block w-full"  value=" {{ Auth::user()->id }}"/>
                    <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
                </div>
                <!-- Selecione o veículo -->
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="vehicle_id" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Veículo</label>
                        <select id="vehicle_id" name="vehicle_id" class="bg-gray-50 uppercase border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione o Veículo</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $serviceOrder->vehicle_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->plate }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selecione a oficina -->
                    <div class="w-full">
                        <label for="workshop_id" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Oficina</label>
                        <select id="workshop_id" name="workshop_id" class="bg-gray-50 uppercase border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione a Oficina</option>
                            @foreach($workshops as $workshop)
                                <option value="{{ $workshop->id }}" {{ old('workshop_id', $serviceOrder->workshop_id ?? '') == $workshop->id ? 'selected' : '' }}>
                                    {{ $workshop->razao_social }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selecione a situação -->
                    <div class="w-full">
                        <label for="situation_id" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Situação</label>
                        <select id="situation_id" name="situation_id" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione a Situação</option>
                            @foreach($situations as $situation)
                                <option value="{{ $situation->id }}" {{ old('situation_id', $serviceOrder->situation_id ?? '') == $situation->id ? 'selected' : '' }}>
                                    {{ $situation->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data do serviço -->
                    <div class="w-full">
                        <label for="service_date" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Data do Serviço</label>
                        <input type="date" id="service_date" value="{{ old('service_date', $serviceOrder->service_date ?? '') }}" name="service_date" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Valor da Hora de Mão de Obra -->
                    <div class="w-full">
                        <label for="labor_hourly_rate" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor da Hora de Mão de Obra</label>
                        <input type="number" step="0.01" id="labor_hourly_rate" name="labor_hourly_rate"
                               value="{{ old('labor_hourly_rate', $serviceOrder->labor_hourly_rate ?? '') }}" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" oninput="calculateLaborTotal()">
                    </div>

                    <!-- Horas de Mão de Obra -->
                    <div class="w-full">
                        <label for="labor_hours" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Horas de Mão de Obra</label>
                        <input type="number" id="labor_hours" name="labor_hours" value="{{ old('labor_hours', $serviceOrder->labor_hours ?? '') }}" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" oninput="calculateLaborTotal()">
                    </div>
                </div>

                <!-- Lista de Produtos -->
                <div id="product-list">
                    @foreach(old('product_id', $serviceOrder->products->pluck('id')->toArray()) as $index => $productId)
                        <div class="product-item mb-4 flex items-center uppercase text-sm font-medium text-gray-900 dark:text-white">
                            <select name="product_id[]" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" required onchange="updatePrice(this)">
                                <option value="">Selecione um Produto</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id.' . $index, $productId) == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" name="quantity[]" value="{{ old('quantity.' . $index, $serviceOrder->products[$index]->pivot->product_quantity ?? '') }}" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Quantidade" min="1" required oninput="updateTotal(this)">
                            <input type="number" name="product_price[]" value="{{ old('product_price.' . $index, $serviceOrder->products[$index]->pivot->product_price ?? '') }}" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Preço Unitário" step="0.01" required readonly>
                            <input type="number" name="total_value[]" value="{{ old('total_value.' . $index, $serviceOrder->products[$index]->pivot->total_value ?? '') }}" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Total" step="0.01" required readonly>
                            <button type="button" onclick="removeProduct(this)" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                Remover
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addProduct()" class="text-blue-600 inline-flex items-center hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-blue-900">
                    Adicionar Produto
                </button>

                <div class="mb-4">
                    <label for="description" class="block mb-2">Descrição</label>
                    <textarea
                        name="description" id="description"
                        class="w-full p-2 border rounded">{{ old('description', $serviceOrder->description ?? '') }}</textarea>
                </div>

                <!-- Valores Totais -->
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="order_total" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor total dos produtos:</label>
                        <input type="text" id="order_total" name="order_total" value="{{ old('order_total', $serviceOrder->order_total ?? '') }}" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                    </div>
                    <div class="w-full">
                        <label for="labor_total" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Total da Mão de Obra:</label>
                        <input type="text" id="labor_total"  name="labor_total" value="{{ old('labor_total', $serviceOrder->labor_total ?? '') }}"  class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="total_service_order" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor total da Ordem:</label>
                        <input type="text" id="total_service_order" name="total_service_order" value="{{ old('total_service_order',$serviceOrder->total_service_order ?? '') }}" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                    </div>
                </div>

                <button type="submit" class="uppercase bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar Ordem</button>
            </form>
        </div>
    </section>
</x-admin-layout>

