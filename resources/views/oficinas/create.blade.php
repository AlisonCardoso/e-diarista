<x-admin-layout>
<form action="{{ route('oficinas.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>
    <!-- Campos de Oficina -->
    <div>
        <label for="razao_social" class="block text-sm font-medium text-gray-700">Razão Social</label>
        <input type="text" name="razao_social" id="razao_social" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>
    <!-- Campos de Endereço -->
   @livewire('buscar-cep')
    <!-- Botão de Enviar -->
    <div>
        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Cadastrar</button>
    </div>
</form>


</x-admin-layout>