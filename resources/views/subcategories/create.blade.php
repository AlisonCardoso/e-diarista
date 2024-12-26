<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($subcategory) ? 'Editar Subcategoria' : 'Nova Subcategoria' }}</h1>

        <form action="{{ isset($subcategory) ? route('subcategories.update', $subcategory) : route('subcategories.store') }}" method="POST">
            @csrf
            @if (isset($subcategory))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block mb-2">Nome da Subcategoria</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $subcategory->name ?? '') }}"
                    class="w-full p-2 border rounded @error('name') border-red-500 @enderror"
                    required
                    maxlength="50"
                >
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block mb-2">Categoria</label>
                <select name="category_id" id="category_id" class="w-full p-2 border rounded @error('category_id') border-red-500 @enderror" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $subcategory->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($subcategory) ? 'Atualizar' : 'Salvar' }}
            </button>
        </form>

        <h2 class="text-xl font-bold mt-6 mb-4">Subcategorias Cadastradas</h2>

        <table class="min-w-full border-collapse border border-indigo-300">
            <thead>
                <tr>
                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">ID</th>
                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Nome</th>
                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Categoria</th>
                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Ações</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $sub)
                <tr class="hover:bg-indigo-200">
                    <td class="py-4 px-6 text-gray-700 uppercase text-sm">{{ $sub->id }}</td>
                    <td class="py-4 px-6 text-gray-700 uppercase text-sm">{{ $sub->name }}</td>
                    <td class="py-4 px-6 text-gray-700 uppercase text-sm">{{ $sub->category->name }}</td>
                    
                    <td class="py-4 px-6 text-gray-700 uppercase text-sm">
                          
                    <a href="{{ route('subcategories.edit', $sub) }}" class="text-blue-500 py-4 px-6  hover:underline">Editar</a>
                            <form action="{{ route('subcategories.destroy', $sub) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" text-red-500 py-4 px-6  hover:underline" onclick="return confirm('Tem certeza que deseja excluir esta subcategoria?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $subcategories->links() }} <!-- Adiciona links de paginação -->
    </div>
</x-admin-layout>
