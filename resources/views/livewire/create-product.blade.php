<x-admin-layout>
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Create Product</h2>

    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="storeProduct" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" wire:model="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" wire:model="category" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" wire:change="updatedCategory">
                <option value="">Select a Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="sub-category">Subcategoria:</label>
            <select id="sub-category" wire:model="selectedSubCategory" {{ !$selectedCategory ? 'disabled' : '' }}>
                <option value="">Selecione uma subcategoria</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Create Product</button>
    </form>

    <h2 class="text-2xl font-bold mt-8 mb-4">Products</h2>

    <table class="min-w-full divide-y divide-gray-200 mt-4">
        <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subcategory</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($products as $product)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->description }}</td>
                </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
</x-admin-layout>

