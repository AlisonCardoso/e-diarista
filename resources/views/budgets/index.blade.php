<x-admin-layout>
    <div class="mt-6">
        <div class="bg-white shadow rounded-md overflow-hidden my-6">

            <!-- Botão para criar novo orçamento -->
            <div class="flex justify-start mb-4">
                <a href="{{ route('budgets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-plus"></i> Novo orçamento
                </a>
            </div>

            <!-- Mensagens de sucesso e erro -->
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

            <!-- Tabela -->
            <table class="min-w-full table-auto border-collapse border border-gray-300 rounded-md">
                <thead>
                    <tr class="bg-gray-700 text-white text-sm">
                        <th class="py-3 px-5 text-left">ID</th>
                        <th class="py-3 px-5 text-left">Veículo</th>
                        <th class="py-3 px-5 text-left">Oficina</th>
                        <th class="py-3 px-5 text-left">Data do Serviço</th>
                        <th class="py-3 px-5 text-left">Total do Orçamento</th>
                        <th class="py-3 px-5 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($budgets as $budget)
                        <tr class="hover:bg-indigo-100">
                            <td class="py-4 px-6 text-gray-700">{{ $budget->id }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $budget->vehicle->plate ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $budget->workshop->razao_social ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $budget->service_date }}</td>
                            <td class="py-4 px-6 text-gray-700">
                                {{ $budget->total_value }} <!-- Total calculado do orçamento -->
                            </td>
                            <td class="py-4 px-6 text-gray-700">
                                <a href="{{ route('budgets.edit', $budget) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir este orçamento?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Exibe os produtos associados a este orçamento -->
                        <tr>
                            <td colspan="6" class="bg-gray-100">
                                <table class="min-w-full table-auto border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-500 text-white text-sm">
                                            <th class="py-2 px-5 text-left">Produto</th>
                                            <th class="py-2 px-5 text-left">Quantidade</th>
                                            <th class="py-2 px-5 text-left">Preço Unitário</th>
                                            <th class="py-2 px-5 text-left">Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($budget->products as $product)
                                            <tr>
                                                <td class="py-2 px-5 text-gray-700">{{ $product->name }}</td>
                                                <td class="py-2 px-5 text-gray-700">{{ $product->pivot->product_quantity }}</td>
                                                <td class="py-2 px-5 text-gray-700">{{ number_format($product->pivot->product_price, 2, ',', '.') }}</td>
                                                <td class="py-2 px-5 text-gray-700">{{ number_format($product->pivot->total_product_value, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Não há orçamentos cadastrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="mt-6">
              {{--   {{ $budgets->links() }}  <!-- Links de paginação -->--}}
            </div>
        </div>
    </div>
</x-admin-layout>
