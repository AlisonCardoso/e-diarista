<div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <div class="mb-6">
            <label for="cep" class="block text-gray-700  uppercase dark:text-gray-200">CEP</label>
            <input type="text"  name="cep" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('cep', $edit->address->cep ?? '') }}" id="cep" wire:model.lazy="cep" placeholder="Insira o CEP (Apenas números)" required>
            @error('cep') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="state" class="block text-gray-700  uppercase dark:text-gray-200">Estado</label>
            <input type="text" id="state" name="state" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('state', $edit->address->state ?? '') }}" wire:model="state" required>
            @error('state') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="city" class="block text-gray-700  uppercase dark:text-gray-200">Cidade</label>
            <input type="text" id="city" name="city" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('city', $edit->address->city ?? '') }}"  wire:model="city" required>
            @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="neighborhood" class="block text-gray-700  uppercase dark:text-gray-200">Bairro</label>
            <input type="text" id="neighborhood" name="neighborhood" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('neighborhood', $edit->address->neighborhood ?? '') }}" wire:model="neighborhood" required>
            @error('neighborhood') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="street" class="block text-gray-800 dark:text-gray-300">Rua</label>
            <input type="text" name="street" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('street', $edit->address->street ?? '') }}"  id="street" wire:model="street" required>
            @error('street') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

</div>
