
<div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <div class="mb-6">
            <label for="cnpj" class="block text-gray-700 uppercase dark:text-gray-200">cnpj</label>
            <input type="text"  name="cnpj" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('cnpj', $edit->address->cnpj ?? '') }}" id="cnpj" wire:model.lazy="cnpj" placeholder="Insira o cnpj (Apenas números)" required>
            @error('cnpj') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="razao_social" class="block text-gray-700 uppercase dark:text-gray-200">razao social</label>
            <input type="text" id="razao_social" name="razao_social" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('razao_social', $workshop->address->razao_social ?? '') }}" wire:model="razao_social" required>
            @error('razao_social') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
   
       
        <div class="mb-6">
            <label for="descricao_situacao_cadastral" class="block text-gray-700 uppercase dark:text-gray-200">Situacao cadastral</label>
            <input type="text" id="descricao_situacao_cadastral" name="descricao_situacao_cadastral" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('descricao_situacao_cadastral', $workshop->address->descricao_situacao_cadastral ?? '') }}"  wire:model="descricao_situacao_cadastral" required>
            @error('descricao_situacao_cadastral') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>
       

        
    
        <div>
            <label for="cnae_fiscal_descricao" class="block text-gray-700  uppercase dark:text-gray-200">Descricao</label>
            <input type="text" id="cnae_fiscal_descricao" name="cnae_fiscal_descricao" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ old('cnae_fiscal_descricao', $workshop->address->cnae_fiscal_descricao ?? '') }}" wire:model="cnae_fiscal_descricao" required>
            @error('cnae_fiscal_descricao') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

    </div>

</div>

        <!-- Campo Descrição do CNAE -->
      