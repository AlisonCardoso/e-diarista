<x-admin-layout>
    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12 mt-12">
        <div class="bg-white dark:bg-gray-900 w-full shadow rounded p-8 sm:p-12">

            <!-- alerta de mensagens de sucesso ou erros-->
            <x-alert/>

            <div class="flex justify-start mb-4">
                <a href="{{ route('workshops.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

 

                <form action="{{ isset($workshop) ? route('workshops.update', $workshop) : route('workshops.store') }}" method="POST">
            @csrf
            @if (isset($workshop))
                @method('PUT')
            @endif

    <div>
    @livewire('buscar-cnpj')

<div class="grid grid-cols-1 sm:grid-cols-3 xm:grid-cols-3 gap-6 mb-6">
    <!-- Campo Telefone -->
    <div>
        <label for="phone_number" class="block text-gray-800 dark:text-gray-300">Telefone</label>
        <input
            type="text" id="phone_number" name="phone_number" placeholder="Digite o Telefone (Apenas números)"
            class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500"
            value="{{ old('phone_number', $workshop->phone_number ?? '') }}" >
        @error('phone_number') <span class="text-red-500" aria-live="polite">{{ $message }}</span> @enderror
    </div>

    <!-- Campo E-mail -->
    <div>
        <label for="email" class="block text-gray-800 dark:text-gray-300">E-mail</label>
        <input
            type="email" id="email" name="email" placeholder="Digite o E-mail (exemplo@dominio.com)"
            class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500"
            value="{{ old('email', $workshop->email ?? '') }}">
        @error('email') <span class="text-red-500" aria-live="polite">{{ $message }}</span> @enderror
    </div>

    <!-- Campo Responsável -->
    <div>
        <label for="responsavel" class="block text-gray-800 dark:text-gray-300">Responsável</label>
        <input
            type="text" id="responsavel" name="responsavel" placeholder="Nome do Responsável"
            class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500"
            value="{{ old('responsavel', $workshop->responsavel ?? '') }}" >
        @error('responsavel') <span class="text-red-500" aria-live="polite">{{ $message }}</span> @enderror
    </div>
</div>

    @livewire('buscar-cep')

      <!-- Campo Número -->
      <div>
                        <label for="number" class="block text-gray-800 dark:text-gray-300">Número</label>
                        <input
                            type="text" id="number" name="number"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500"
                            value="{{ old('number', $workshop->address->number ?? '') }}" >
                        @error('number') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Campo Complemento -->
                    <div>
                        <label for="complement" class="block text-gray-800 dark:text-gray-300">Complemento</label>
                        <input
                            type="text" id="complement" name="complement"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500"
                            value="{{ old('complement', $workshop->address->complement ?? '') }}">
                        @error('complement') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>


    </div>



    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($workshop) ? 'Atualizar' : 'Salvar' }}
            </button>
</form>
        </div>
    </div>


</x-admin-layout>
