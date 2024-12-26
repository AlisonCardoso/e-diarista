
    // Script para adicionar funções de cálculo

    function updatePrice(selectElement) {
        const price = parseFloat(selectElement.selectedOptions[0].getAttribute('data-price')) || 0;
        const productItem = selectElement.closest('.product-item');
        productItem.querySelector('input[name="product_price[]"]').value = price;
        updateTotal(selectElement);
    }

    function updateTotal(inputElement) {
        const productItem = inputElement.closest('.product-item');
        const quantity = parseFloat(productItem.querySelector('input[name="quantity[]"]').value) || 0;
        const price = parseFloat(productItem.querySelector('input[name="product_price[]"]').value) || 0;
        const totalValue = productItem.querySelector('input[name="total_value[]"]');
        totalValue.value = (quantity * price).toFixed(2);

        calculateOrderTotal();
    }

    function calculateOrderTotal() {
        let orderTotal = 0;
        document.querySelectorAll('input[name="total_value[]"]').forEach(input => {
            orderTotal += parseFloat(input.value) || 0;
        });
        document.getElementById('order_total').value = orderTotal.toFixed(2);

        calculateServiceOrderTotal();
    }

    function calculateLaborTotal() {
        const hourlyRate = parseFloat(document.getElementById('labor_hourly_rate').value) || 0;
        const hours = parseFloat(document.getElementById('labor_hours').value) || 0;
        const laborTotal = hourlyRate * hours;
        document.getElementById('labor_total').value = laborTotal.toFixed(2);

        calculateServiceOrderTotal();
    }

    function calculateServiceOrderTotal() {
        const laborTotal = parseFloat(document.getElementById('labor_total').value) || 0;
        const orderTotal = parseFloat(document.getElementById('order_total').value) || 0;
        const totalServiceOrder = laborTotal + orderTotal;
        document.getElementById('total_service_order').value = totalServiceOrder.toFixed(2);
    }

    function addProduct() {
        const productItem = document.querySelector('.product-item');
        const newProductItem = productItem.cloneNode(true);
        newProductItem.querySelectorAll('input').forEach(input => input.value = '');
        document.getElementById('product-list').appendChild(newProductItem);
    }

    function removeProduct(button) {
        button.closest('.product-item').remove();
        calculateOrderTotal();
    }
