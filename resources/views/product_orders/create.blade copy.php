<x-admin-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-start mb-4">
            <a href="{{ route('product_orders.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                <i class="fas fa-plus"></i> Voltar
            </a>
        </div>

        <h2 class="text-2xl font-semibold mb-6">Criar Ordem de Produtos</h2>

        <form action="{{ route('product_orders.store') }}" method="POST" class="space-y-6">
            @csrf

            <select class="js-example-basic-single" name="state">
                <option value="AL">Alabama</option>
                  ...
                <option value="WY">Wyoming</option>
              </select>

              <div>
                <select class="js-example-responsive" style="width: 50%"></select>
                <select class="js-example-responsive" multiple="multiple" style="width: 75%"></select>
              </div>

            <div id="product-list">
                <div class="product-item mb-4 flex items-center">
                    <select name="product_id" class="p-2 border rounded mr-2" required onchange="updatePrice(this)">
                        <option value="">Selecione um Produto</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="quantity[]" class="p-2 border rounded mr-2" placeholder="Quantidade" min="1" required oninput="updateTotal(this)">

                    <input type="number" name="product_price[]" class="p-2 border rounded mr-2" placeholder="Preço Unitário" step="0.01" required readonly>

                    <input type="number" name="total_value[]" class="p-2 border rounded mr-2" placeholder="Total" step="0.01" required readonly>

                    <button type="button" onclick="removeProduct(this)" class="text-red-500 ml-2">Remover</button>
                </div>
            </div>

            <button type="button" onclick="addProduct()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Adicionar Produto</button>

            <div class="mt-6">
                <label for="order_total" class="block text-lg font-semibold">Valor Total dos produtos:</label>
                <input type="text" id="order_total" class="p-2 border rounded w-full" readonly>
            </div>
            <div class="mt-6">
                <label for="total_product_value" class="block text-lg font-semibold">Valor Total da Ordem:</label>
                <input type="text" id="total_product_value" class="p-2 border rounded w-full" readonly>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mt-4">Salvar Ordem de Produto</button>
        </form>
    </div>

    {{--     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');  // Quantidade de produtos utilizados
            $table->decimal('product_price', 10, 2);  // Preço unitário no momento da ordem
            $table->decimal('total_product_value', 10, 2)->virtualAs('quantity * product_price'); // Valor total
            --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let productIndex = 1;
            const productList = document.getElementById('product-list');
            const orderTotalInput = document.getElementById('order_total');

            // Função para adicionar um novo produto
            window.addProduct = function() {
                const newProductItem = document.createElement('div');
                newProductItem.classList.add('product-item', 'mb-4', 'flex', 'items-center');
                newProductItem.innerHTML = `
                    <select name="product_id[]" class="p-2 border rounded mr-2" required onchange="updatePrice(this)">
                        <option value="">Selecione um Produto</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="quantity[]" class="p-2 border rounded mr-2" placeholder="Quantidade" min="1" required oninput="updateTotal(this)">

                    <input type="number" name="product_price[]" class="p-2 border rounded mr-2" placeholder="Preço Unitário" step="0.01" required readonly>

                    <input type="number" name="total_value[]" class="p-2 border rounded mr-2" placeholder="Total" step="0.01" required readonly>

                    <button type="button" onclick="removeProduct(this)" class="text-red-500 ml-2">Remover</button>
                `;
                productList.appendChild(newProductItem);
                productIndex++;
            };

            // Função para remover um produto
            window.removeProduct = function(button) {
                button.parentElement.remove();
                updateOrderTotal();
            };

            // Função para atualizar o preço unitário e o valor total de um produto
            window.updatePrice = function(select) {
                const price = select.selectedOptions[0].dataset.price;
                const quantityInput = select.parentElement.querySelector('input[name="quantity[]"]');
                const priceInput = select.parentElement.querySelector('input[name="product_price[]"]');
                priceInput.value = price;
                updateTotal(quantityInput);
            };

            // Função para calcular o valor total de um produto
            window.updateTotal = function(input) {
                const quantity = input.value;
                const price = input.closest('.product-item').querySelector('input[name="product_price[]"]').value;
                const totalInput = input.closest('.product-item').querySelector('input[name="total_value[]"]');

                if (quantity && price) {
                    totalInput.value = (quantity * price).toFixed(2);
                } else {
                    totalInput.value = 0;
                }
                updateOrderTotal();
            };

            // Função para atualizar o valor total da ordem
            window.updateOrderTotal = function() {
                const totalInputs = document.querySelectorAll('input[name="total_value[]"]');
                let orderTotal = 0;

                totalInputs.forEach(input => {
                    orderTotal += parseFloat(input.value) || 0;
                });

                orderTotalInput.value = orderTotal.toFixed(2);
            };
        });
    </script>
</x-admin-layout>
