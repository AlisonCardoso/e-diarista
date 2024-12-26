<x-admin-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-4xl px-4 py-8 mx-auto lg:py-16">

            @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-4 rounded-md shadow-sm">
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-4 rounded-md shadow-sm">
                <span class="font-semibold">{{ session('error') }}</span>
            </div>

        @endif
            <h2 class="mb-4 text-xl font-bold uppercase text-gray-900 dark:text-white">Criar Ordem de Serviço</h2>

            <form method="POST"
            action="{{ isset($budget) ? route('budgets.update', $budget) : route('budgets.store') }}"
            enctype="multipart/form-data">
          @csrf

          @if (isset($budget))
              @method('PUT')
          @endif


                <!-- Selecione o veículo -->
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="vehicle_id" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Veículo</label>
                        <select id="vehicle_id" name="vehicle_id" class="bg-gray-50 uppercase border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione o Veículo</option>
                            @if($vehicles && $vehicles->count() > 0)
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate }}</option>
                            @endforeach
                            @else
                                <option value="">Nenhum veículo encontrado</option>
                            @endif
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('vehicle_id')" />


                    </div>

                    <!-- Selecione a oficina -->
                    <div class="w-full">
                        <label for="workshop_id" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Oficina</label>
                        <select id="workshop_id" name="workshop_id" class="bg-gray-50 uppercase border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione a Oficina</option>
                            @foreach($workshops as $workshop)
                                <option value="{{ $workshop->id }}">{{ $workshop->razao_social }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('workshop_id')" />
                    </div>

                    <!-- Selecione a situação -->
                    <div class="w-full">
                        <label for="situation_id" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Situação</label>
                        <select id="situation_id" name="situation_id" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione a Situação</option>
                            @foreach($situations as $situation)
                                <option value="{{ $situation->id }}">{{ $situation->description }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('situation_id')" />
                    </div>

                    <!-- Data do serviço -->
                    <div class="w-full">
                        <label for="service_date" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Data do Serviço</label>
                        <input type="date" id="service_date" name="service_date" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <x-input-error class="mt-2" :messages="$errors->get('service_date')" />
                    </div>

                    <!-- Valor da Hora de Mão de Obra -->
                    <div class="w-full">
                        <label for="labor_hourly_rate" class="block mb-2 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor da Hora de Mão de Obra</label>
                        <input type="number" step="0.01" id="labor_hourly_rate" name="labor_hourly_rate" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" oninput="calculateLaborTotal()">
                        <x-input-error class="mt-2" :messages="$errors->get('labor_hourly_rate')" />
                    </div>

                    <!-- Horas de Mão de Obra -->
                    <div class="w-full">
                        <label for="labor_hours" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Horas de Mão de Obra</label>
                        <input type="number" id="labor_hours" name="labor_hours" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" oninput="calculateLaborTotal()">
                        <x-input-error class="mt-2" :messages="$errors->get('labor_hours')" />
                    </div>
                </div>

                <!-- Lista de Produtos -->
                <div id="product-list">
                    <div class="product-item mb-4 flex items-center uppercase text-sm font-medium text-gray-900 dark:text-white">
                        <select name="product_id[]" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" required onchange="updatePrice(this)">
                            <option value="">Selecione um Produto</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantity[]" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Quantidade" min="1" required oninput="updateTotal(this)">
                        <input type="number" name="product_price[]" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Preço Unitário" step="0.01" required readonly>
                        <input type="number" name="total_value[]" class="p-2 border rounded mr-2 bg-gray-50 uppercase border-gray-300 text-gray-900 text-sm" placeholder="Total" step="0.01" required readonly>
                        <button type="button" onclick="removeProduct(this)" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Remover
                        </button>
                        <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
                    </div>
                </div>
                <button type="button" onclick="addProduct()" class="text-blue-600 inline-flex items-center hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-blue-900">
                    Adicionar Produto
                </button>

                <!-- Valores Totais -->
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="order_total" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor total dos produtos:</label>
                        <input type="text" id="order_total" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                    </div>
                    <div class="w-full">
                        <label for="labor_total" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Total da Mão de Obra:</label>
                        <input type="text" id="labor_total" name="labor_total" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                        <x-input-error class="mt-2" :messages="$errors->get('labor_total')" />
                    </div>

                    <div class="w-full">
                        <label for="total_service_order" class="block mb-4 uppercase text-sm font-medium text-gray-900 dark:text-white">Valor total da Ordem:</label>
                        <input type="text" id="total_service_order" name="total_service_order" class="bg-gray-50 border uppercase border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                        <x-input-error class="mt-2" :messages="$errors->get('total_service_order')" />
                    </div>
                </div>
                <button type="submit" class="uppercase bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar Ordem</button>
            </form>
        </div>
    </section>


    <script>
        // Função para atualizar o preço do produto com base no valor selecionado
        function updatePrice(selectElement) {
            const price = parseFloat(selectElement.selectedOptions[0].getAttribute('data-price')) || 0;
            const productItem = selectElement.closest('.product-item');
            productItem.querySelector('input[name="product_price[]"]').value = price;
            updateTotal(selectElement);
        }

        // Função para atualizar o total de cada produto (quantidade * preço)
        function updateTotal(inputElement) {
            const productItem = inputElement.closest('.product-item');
            const quantity = parseFloat(productItem.querySelector('input[name="quantity[]"]').value) || 0;
            const price = parseFloat(productItem.querySelector('input[name="product_price[]"]').value) || 0;
            const totalValue = productItem.querySelector('input[name="total_value[]"]');
            totalValue.value = (quantity * price).toFixed(2);

            calculateOrderTotal();
        }

        // Função para calcular o total dos produtos
        function calculateOrderTotal() {
            let orderTotal = 0;
            document.querySelectorAll('input[name="total_value[]"]').forEach(input => {
                orderTotal += parseFloat(input.value) || 0;
            });
            document.getElementById('order_total').value = orderTotal.toFixed(2);

            calculateServiceOrderTotal();
        }

        // Função para calcular o total da mão de obra (hora * valor por hora)
        function calculateLaborTotal() {
            const hourlyRate = parseFloat(document.getElementById('labor_hourly_rate').value) || 0;
            const hours = parseFloat(document.getElementById('labor_hours').value) || 0;
            const laborTotal = hourlyRate * hours;
            document.getElementById('labor_total').value = laborTotal.toFixed(2);

            calculateServiceOrderTotal();
        }

        // Função para calcular o valor total da ordem de serviço (produto + mão de obra)
        function calculateServiceOrderTotal() {
            const laborTotal = parseFloat(document.getElementById('labor_total').value) || 0;
            const orderTotal = parseFloat(document.getElementById('order_total').value) || 0;
            const totalServiceOrder = laborTotal + orderTotal;
            document.getElementById('total_service_order').value = totalServiceOrder.toFixed(2);
        }

        // Função para adicionar novos produtos à lista
        function addProduct() {
            const productItem = document.querySelector('.product-item');
            const newProductItem = productItem.cloneNode(true);
            newProductItem.querySelectorAll('input').forEach(input => input.value = ''); // Limpa os valores do novo produto
            document.getElementById('product-list').appendChild(newProductItem);
        }

        // Função para remover um produto da lista
        function removeProduct(button) {
            button.closest('.product-item').remove();
            calculateOrderTotal(); // Recalcula o total dos produtos após remoção
        }

        // Adiciona o evento para calcular o valor total da mão de obra quando o usuário mudar o valor ou a quantidade de horas
        document.getElementById('labor_hourly_rate').addEventListener('input', function () {
            calculateLaborTotal(); // Calcula o total da mão de obra
            calculateServiceOrderTotal(); // Recalcula o total geral da ordem
        });

        document.getElementById('labor_hours').addEventListener('input', function () {
            calculateLaborTotal(); // Calcula o total da mão de obra
            calculateServiceOrderTotal(); // Recalcula o total geral da ordem
        });

        </script>


</x-admin-layout>
