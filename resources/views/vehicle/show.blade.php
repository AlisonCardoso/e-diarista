<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
       
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-semibold text-gray-800 text-center flex-1">Relatório do Veículo</h1>
            <!-- Botão para gerar PDF -->
            <a href="{{ route('vehicle.pdf', $vehicle->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
               Gerar PDF
            </a>
        </div>

        <!-- Detalhes do veículo -->
        <div class="bg-white shadow sm:rounded-lg p-6 mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</h2>
            <p class="text-lg text-gray-600 mt-2">Placa: <span class="font-medium text-blue-600">{{ $vehicle->plate }}</span></p>
            <p class="text-lg text-gray-600">Tabela Fipe: <span class="font-medium text-green-600">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</span></p>
            <p class="text-lg text-gray-600">Cor: <span class="font-medium text-gray-800">{{ $vehicle->color }}</span></p>
            <p class="text-lg text-gray-600">Renavam: <span class="font-medium text-gray-800">{{ $vehicle->renavam }}</span></p>
            <p class="text-lg text-gray-600">Chassi: <span class="font-medium text-gray-800">{{ $vehicle->chassis }}</span></p>
        </div>

        <!-- Soma das ordens de serviço -->
        <div class="bg-white shadow sm:rounded-lg p-6 mb-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Resumo das Ordens de Serviço</h3>
            <p class="text-lg text-gray-700">Total de Ordens de Serviço: 
                <span class="font-semibold text-red-600">R$ {{ number_format($totalOrders, 2, ',', '.') }}</span>
            </p>
        </div>

        <!-- Lista de ordens de serviço -->
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Ordens de Serviço</h3>

            @if($serviceOrders->isEmpty())
                <p class="text-gray-500">Não há ordens de serviço associadas a este veículo.</p>
            @else
                <div class="space-y-6">
                    @foreach ($serviceOrders as $order)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                            <div class="flex justify-between mb-4">
                                <span class="text-xl font-semibold text-gray-800">Ordem de Serviço #{{ $order->id }}</span>
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->service_date)->format('d/m/Y') }}</span>
                            </div>

                            <p class="text-gray-700"><strong>Status:</strong> <span class="text-blue-600">{{ $order->situation->description }}</span></p>
                            <p class="text-gray-700"><strong>Total:</strong> R$ {{ number_format($order->total_service_order, 2, ',', '.') }}</p>
                            <p class="text-gray-600 mt-2"><strong>Descrição:</strong> {{ $order->description }}</p>

                            <div class="mt-4">
                                <p class="text-gray-600"><strong>Horas de Trabalho:</strong> {{ $order->labor_hours }} horas</p>
                                <p class="text-gray-600"><strong>Taxa por Hora:</strong> R$ {{ number_format($order->labor_hourly_rate, 2, ',', '.') }}</p>
                                <p class="text-gray-600"><strong>Total de Mão de Obra:</strong> R$ {{ number_format($order->labor_total, 2, ',', '.') }}</p>
                            </div>

                            <!-- Tabela de produtos associados -->
                            @if($order->products->isNotEmpty())
                                <div class="mt-4">
                                    <h4 class="text-lg font-semibold text-gray-800">Produtos Associados</h4>
                                    <table class="min-w-full bg-white border border-gray-300 mt-4">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 text-left text-gray-700 border-b">Produto</th>
                                                <th class="px-4 py-2 text-left text-gray-700 border-b">Quantidade</th>
                                                <th class="px-4 py-2 text-left text-gray-700 border-b">Preço Unitário</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $product)
                                                <tr class="border-b">
                                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                                    <td class="px-4 py-2">{{ $product->pivot->product_quantity }}</td>
                                                    <td class="px-4 py-2">R$ {{ number_format($product->pivot->product_price, 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500 mt-2">Nenhum produto associado a esta ordem de serviço.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
