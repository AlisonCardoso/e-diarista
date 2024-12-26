<x-admin-layout>


    <div class="mt-3 mb-4 border border-gray-200 shadow-lg rounded-lg">
        <div class="bg-gray-100 p-4 flex justify-between items-center">
            <span>Pesquisar</span>
        </div>

        <div class="p-4">
            <form action="{{ route('workshops.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"  placeholder="Nome da conta" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="data_inicio">Data Início</label>
                        <input type="date" name="data_inicio" id="data_inicio" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="data_fim">Data Fim</label>
                        <input type="date" name="data_fim" id="data_fim" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <div class="flex flex-col gap-2 mt-3 pt-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Pesquisar</button>
                        <a href="{{ route('workshops.index') }}" class="bg-yellow-500 text-white py-2 px-4 rounded-md text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Limpar</a>
                    </div>

                </div>
            </form>
        </div>
    </div>




    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            <div class="mt-8">

<x-alert/>
                <div class="flex justify-start mb-4">
                    <a href="{{ route('workshops.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        <i class="fas fa-plus"></i> Nova Oficina
                    </a>
                </div>

                <div class="flex flex-col mt-6">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="py-3 px-5 bg-gray-700 uppercase leading-4 font-medium text-gray-100 tracking-wider">Cidade</th>
                                    <th class="py-3 px-5 bg-gray-700 uppercase leading-4 font-medium text-gray-100 tracking-wider">CNPJ</th>
                                    <th class="py-3 px-5 bg-gray-700 uppercase leading-4 font-medium text-gray-100 tracking-wider">Razão Social</th>
                                    <th class="py-3 px-5 bg-gray-700 uppercase leading-4 font-medium text-gray-100 tracking-wider">Telefone</th>
                                    <th class="py-3 px-5 bg-gray-700 uppercase leading-4 font-medium text-gray-100 tracking-wider">Responsável</th>
                                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Editar</th>
                                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Mostrar</th>
                                    <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Excluir</th>
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-400">
                                @forelse ($workshops as $workshop)
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-6 border-b text-gray-700 uppercase text-sm">{{ $workshop->address->city }}</td>
                                        <td class="px-6 border-b text-gray-700 uppercase text-sm">{{ $workshop->cnpj }}</td>
                                        <td class="px-6 border-b text-gray-700 uppercase text-sm">{{ $workshop->razao_social }}</td>
                                        <td class="px-6 border-b text-gray-700 uppercase text-sm">{{ $workshop->phone_number }}</td>
                                        <td class="px-6 border-b text-gray-700 uppercase text-sm">{{ $workshop->responsavel }}</td>

                                        <td class="px-6 py-4">
                                            <a href="{{ route('workshops.edit', $workshop->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td class="px-6 py-4">
                                            <a href="{{ route('workshops.show', $workshop->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td class="px-6 py-4">

                                            <form id="formDeleteWorkshop{{ $workshop->id }}" action="{{ route('workshops.destroy', $workshop) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" 
                                                onclick="confirmDelete(event, 'formDeleteWorkshop{{ $workshop->id }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Não há oficinas cadastradas.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $workshops->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
