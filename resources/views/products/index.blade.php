<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Produtos</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Novo Produto</a>
<x-alert/>

    <table class="w-full border-collapse bg-white rounded-lg shadow">
            <thead>
                <tr class="text-left bg-gray-200">
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">ID</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Nome</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Descrição</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Preço</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Estoque</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-b hover:bg-gray-100">
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $product->id }}</td>
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $product->name }}</td>
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $product->description }}</td>
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $product->stock }}</td>
                       <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">
                            <a href="{{ route('products.edit', $product) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>