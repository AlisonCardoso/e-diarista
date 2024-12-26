<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($category) ? 'Editar Categoria' : 'Nova Categoria' }}</h1>

        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block mb-2">Nome da Categoria</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $category->name ?? '') }}"
                    class="w-full p-2 border rounded @error('name') border-red-500 @enderror"
                    required
                    maxlength="50"  >
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($category) ? 'Atualizar' : 'Salvar' }}
            </button>
        </form>
        <h2 class="text-xl font-bold mt-6 mb-4">Categorias Cadastradas</h2>

<table class="min-w-full border-collapse border border-gray-300">
    <thead>
        <tr>
            <th class="border border-gray-300 p-2">ID</th>
            <th class="border border-gray-300 p-2">Nome</th>
            <th class="border border-gray-300 p-2">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td class="border border-gray-300 p-2">{{ $category->id }}</td>
                <td class="border border-gray-300 p-2">{{ $category->name }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-500 hover:underline">Editar</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $categories->links() }} <!-- Adiciona links de paginação -->
</div>
</x-admin-layout>
