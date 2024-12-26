<x-admin-layout>


<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Lista de Oficinas</h1>
    <a href="{{ route('oficinas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Novo Serviço</a>

      

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Razão Social</th>
                <th class="py-3 px-6 text-left">CNPJ</th>
                <th class="py-3 px-6 text-left">Responsável</th>
                <th class="py-3 px-6 text-left">Endereço</th>
                <th class="py-3 px-6 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @foreach($oficinas as $oficina)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $oficina->razao_social }}</td>
                    <td class="py-3 px-6 text-left">{{ $oficina->cnpj }}</td>
                    <td class="py-3 px-6 text-left">{{ $oficina->responsavel }}</td>
                    <td class="py-3 px-6 text-left">
                        @if($oficina->address)
                            {{ $oficina->address->street }}, {{ $oficina->address->number }} - 
                            {{ $oficina->address->neighborhood }}, {{ $oficina->address->city }} - 
                            {{ $oficina->address->state }} ({{ $oficina->address->cep }})
                        @else
                            <span class="text-gray-500">Sem endereço</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('oficinas.edit', $oficina->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                        <form action="{{ route('oficinas.destroy', $oficina->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $subcategories->links() }}
</div>


</x-admin-layout>