<x-admin-layout>
      <div class="mt-6">
        <div class="bg-white shadow rounded-md overflow-hidden my-6">


            <div class="flex justify-start mb-4">
                <a href="{{ route('product_orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-plus"></i> Novo orçamento de produtos
                </a>
            </div>
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
                    <th class="py-3 px-5 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productOrders as $productOrder)
                <tr class="hover:bg-indigo-100">
                    <td class="py-4 px-6 text-gray-700">{{ $productOrder->id }}</td>
                    <td class="py-4 px-6 text-gray-700">{{ $productOrder->vehicle->plate ?? 'N/A' }}</td>
                    <td class="py-4 px-6 text-gray-700">{{ $productOrder->workshop->razao_social ?? 'N/A' }}</td>
                    <td class="py-4 px-6 text-gray-700">{{ $productOrder->product_date }}</td>
                    <td class="py-4 px-6 text-gray-700">

                    <a href="{{ route('product_orders.edit',  $productOrder) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('product_orders.destroy',  $productOrder) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                    </td>
                </tr>
                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Não há orçamentos cadastradas.</td>
                                    </tr>
                                @endforelse
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-6">
           {{ $productOrders->links() }}  <!-- Links de paginação -->
        </div>
    </div>
<
</x-admin-layout>
