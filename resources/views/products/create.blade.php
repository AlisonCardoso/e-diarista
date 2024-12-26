<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($product) ? 'Editar Produto' : 'Novo Produto' }}</h1>

        <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            @livewire('SelectCategoria', ['product' => $product ?? null])

            <div class="mb-4">
                <label for="name" class="block mb-2">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $product->name ?? '') }}"
                    class="w-full p-2 border rounded"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Descrição</label>
                <textarea
                    name="description"
                    id="description"
                    class="w-full p-2 border rounded"
                >{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block mb-2">Preço</label>
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    id="price"
                    value="{{ old('price', $product->price ?? '') }}"
                    class="w-full p-2 border rounded"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="stock" class="block mb-2">Estoque</label>
                <input
                    type="number"
                    name="stock"
                    id="stock"
                    value="{{ old('stock', $product->stock ?? '') }}"
                    class="w-full p-2 border rounded"
                    required
                >
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($product) ? 'Atualizar' : 'Salvar' }}
              
            </button>

        
            
        </form>
    </div>
</x-admin-layout>
