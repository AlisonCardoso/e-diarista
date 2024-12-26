<x-admin-layout>
    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-900 p-8 sm:p-12 shadow-xl rounded-xl">
            <!-- Mensagem de Sucesso -->
            @if (session()->has('success'))
                <div class="text-green-500 my-4 p-4 bg-green-100 rounded-md shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Voltar Button -->
            <div class="flex justify-start mb-6">
                <a href="{{ route('workshops.index') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-blue-600 flex items-center space-x-2 transition duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Voltar</span>
                </a>
            </div>

            <!-- Workshop Info -->
            <div class="space-y-8">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ isset($workshop) ? 'Editar Workshop' : 'Detalhes do Workshop' }}</h2>

                <!-- Detalhes do Workshop -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Responsável</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $workshop->responsavel ?? 'Não informado' }}</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Telefone</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $workshop->phone_number ?? 'Não informado' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">E-mail</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $workshop->email ?? 'Não informado' }}</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Endereço</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            {{ $workshop->address->street ?? 'Não informado' }},
                            {{ $workshop->address->number ?? 'Nº' }},
                            {{ $workshop->address->complement ?? 'Complemento' }}
                        </p>
                    </div>
                </div>

                <!-- Foto ou Imagem do Workshop -->
                @if ($workshop->image)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Imagem do Workshop</h3>
                        <img src="{{ asset('storage/' . $workshop->image) }}" alt="Imagem do Workshop" class="w-full mt-4 rounded-lg shadow-lg">
                    </div>
                @endif
            </div>

            <!-- Footer with Buttons -->
            <div class="flex space-x-4 mt-8">
                <a href="{{ route('workshops.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-300">
                    Voltar
                </a>

                <a href="{{ route('workshops.edit', $workshop->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg transition duration-300">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
