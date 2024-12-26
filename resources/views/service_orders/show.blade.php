{{-- resources/views/service_orders/show.blade.php --}}
<x-admin-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-200 dark:bg-slate-800 p-6 rounded-lg shadow-md w-1/2 mt-5">
            <p><strong>ID:</strong> {{ $serviceOrder->id }}</p>
            <p><strong>Veículo:</strong> {{ $serviceOrder->vehicle->name ?? 'N/A' }}</p>
            <p><strong>Oficina:</strong> {{ $serviceOrder->workshop->name ?? 'N/A' }}</p>
            <p><strong>Data do Serviço:</strong> {{ $serviceOrder->service_date }}</p>
            <p><strong>Valor Hora da Mão de Obra:</strong> {{ $serviceOrder->labor_hourly_rate }}</p>
            <p><strong>Duração da Mão de Obra:</strong> {{ $serviceOrder->labor_hours }}</p>
            <p><strong>Total da Mão de Obra:</strong> {{ $serviceOrder->labor_total }}</p>
            <a href="{{ route('service_orders.index') }}" class="btn btn-primary">Voltar para Ordens de Serviço</a>
        </div>
    </div>
</x-admin-layout>
