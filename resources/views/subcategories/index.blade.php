<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($subCategory) ? 'Editar Subcategoria' : 'Nova Subcategoria' }}</h1>

        <!-- Exibir mensagens de sucesso -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

     

        <h2 class="text-xl font-bold mt-6 mb-4">Subcategorias Cadastradas</h2>

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Nome</th>
                    <th class="border border-gray-300 p-2">Categoria</th>
                    <th class="border border-gray-300 p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subCategory)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $subCategory->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $subCategory->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $subCategory->category->name }}</td>
                        <td class="border border-gray-300 p-2">
                            
                            <a href="{{ route('subcategories.edit', $subCategory) }}" class="text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('subcategories.destroy', $subCategory) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $subcategories->links() }} <!-- Adiciona links de paginação -->
    </div>
</x-admin-layout>
