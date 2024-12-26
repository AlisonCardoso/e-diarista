<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Criar Orçamento</h1>

        <form action="{{ route('budgets.store') }}" method="POST">
            @csrf

          

            <h2 class="text-xl font-bold mt-6 mb-4">Adicionar Itens ao Orçamento</h2>

            <div id="items-container">
                <div class="flex items-center space-x-4 mb-4">
                    <select name="items[0][product_id]" class="w-1/2 p-2 border border-gray-300 rounded-md" onchange="updateItem(0)" required>
                        <option value="">Selecione um Produto</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="items[0][quantity]" class="w-20 p-2 border border-gray-300 rounded-md" value="1" min="1" onchange="updateItem(0)" required>

                    <input type="text" name="items[0][price]" class="w-32 p-2 border border-gray-300 rounded-md" readonly>

                    <input type="text" name="items[0][total]" class="w-32 p-2 border border-gray-300 rounded-md" readonly>
                </div>
                <input type="hidden" name="total_amount" value="{{ old('total_amount') }}">
            </div>

            <button type="button" class="mt-4 bg-green-500 text-white px-6 py-2 rounded-md" onclick="addItem()">Adicionar Item</button>

            <h2 class="text-xl font-bold mt-6 mb-4">Total do Orçamento</h2>
            <div class="text-lg font-bold" id="total-amount">R$ 0,00</div>

            <button type="submit" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-md">Salvar Orçamento</button>
        </form>
    </div> <script crc></script>

    <script>
        function addItem() {
            const container = document.getElementById('items-container');
            const itemCount = container.children.length;
            const newItem = document.createElement('div');
            newItem.classList.add('flex', 'items-center', 'space-x-4', 'mb-4');

            newItem.innerHTML = `
                <select name="items[${itemCount}][product_id]" class="w-1/2 p-2 border border-gray-300 rounded-md" onchange="updateItem(${itemCount})" required>
                    <option value="">Selecione um Produto</option>
                    @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}</option>
                    @endforeach
            </select>

            <input type="number" name="items[${itemCount}][quantity]" class="w-20 p-2 border border-gray-300 rounded-md" value="1" min="1" onchange="updateItem(${itemCount})" required>

                <input type="text" name="items[${itemCount}][price]" class="w-32 p-2 border border-gray-300 rounded-md" readonly>

                <input type="text" name="items[${itemCount}][total]" class="w-32 p-2 border border-gray-300 rounded-md" readonly>
            `;

            container.appendChild(newItem);
        }

        function updateItem(index) {
            const select = document.querySelector(`select[name="items[${index}][product_id]"]`);
            const quantityInput = document.querySelector(`input[name="items[${index}][quantity]"]`);
            const priceInput = document.querySelector(`input[name="items[${index}][price]"]`);
            const totalInput = document.querySelector(`input[name="items[${index}][total]"]`);

            const price = parseFloat(select.selectedOptions[0].dataset.price);
            const quantity = parseInt(quantityInput.value);
            const total = price * quantity;

            priceInput.value = `R$ ${price.toFixed(2).replace('.', ',')}`;
            totalInput.value = `R$ ${total.toFixed(2).replace('.', ',')}`;

            updateTotalAmount();
        }

        function updateTotalAmount() {
            let totalAmount = 0;
            const totalInputs = document.querySelectorAll('input[name$="[total]"]');
            totalInputs.forEach(input => {
                totalAmount += parseFloat(input.value.replace('R$ ', '').replace(',', '.'));
            });

            document.getElementById('total-amount').textContent = `R$ ${totalAmount.toFixed(2).replace('.', ',')}`;
        }
    </script>
</x-admin-layout>
