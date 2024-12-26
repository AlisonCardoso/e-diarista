document.addEventListener('DOMContentLoaded', function() {
    calculateOrderTotal();
    calculateLaborTotal();
});
 
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


/* modo dark*/
document.getElementById('theme-toggle').addEventListener('click', function() {
    document.body.classList.toggle('dark'); // Alterna a classe 'dark'
    if (document.body.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
});

// Verifica o tema salvo ao carregar a página
window.addEventListener('load', function() {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
    }
});



/* ssweetAllert alerta de exclusao*/
        function confirmDelete(event, formId) {
            event.preventDefault();
        
            Swal.fire({
                title: 'Você tem certeza?',
                text: 'Você não poderá recuperar este item!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, Excluir',
                cancelButtonText: 'Não, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit(); // Submete o formulário pelo ID recebido
                    Swal.fire({
                        title: "Excluído",
                        text: "O item foi excluído com sucesso.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelado',
                        'O item está seguro!',
                        'error'
                    );
                }
            });
        }
        
    
 

