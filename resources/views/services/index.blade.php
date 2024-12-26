<x-admin-layout>
<div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Serviços</h1>
        <a href="{{ route('services.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Novo Serviço</a>

        @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse bg-white rounded-lg shadow">
            <thead>
                <tr class="text-left bg-gray-200">
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">ID</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Nome</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Preço</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Duração</th>
                     <th class="py-3 px-5 bg-gray-700 font-medium uppercase text-sm text-gray-100">Ações</th>
               </tr>
            </thead>
            <tbody>
            @forelse($services as $service)



             <tr class="border-b hover:bg-gray-200">
                    <td class="px-4 py-2 border-b uppercase text-sm text-gray-700">{{ $service->id }}</td>
                    <td class="py-3 px-5 border-b uppercase text-sm text-gray-700">{{ $service->name }}</td>
                    <td class="py-3 px-5 border-b uppercase text-sm text-gray-700">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                    <td class="py-3 px-5 border-b uppercase text-sm text-gray-700">{{ $service->duration ?? '-' }} horas</td>
                    <td class="py-3 px-5 border-b uppercase text-sm text-gray-700">
                            <a href="{{ route('services.edit', $service) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-2 text-center text-gray-500">Nenhum Serviço cadastrado.</td>
                    </tr>
                @endforelse
                </tbody>
               
        </table> 
       
</div>
</x-admin-layout>
