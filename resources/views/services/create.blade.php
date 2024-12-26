<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">{{ isset($service) ? 'Editar Serviço' : 'Novo Serviço' }}</h1>

        <form action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}" method="POST">
            @csrf
            @if (isset($service))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block mb-2">Nome</label>
                <input
                    type="text" name="name"  id="name" value="{{ old('name', $service->name ?? '') }}"
                    class="w-full p-2 border rounded"  required >
            </div>

            <div class="mb-4">
                <label for="price" class="block mb-2">Preço</label>
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    id="price"
                    value="{{ old('price', $service->price ?? '') }}"
                    class="w-full p-2 border rounded"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="duration" class="block mb-2">Duração (em horas)</label>
                <input
                    type="number"
                    name="duration"
                    id="duration"
                    value="{{ old('duration', $service->duration ?? '') }}"
                    class="w-full p-2 border rounded"
                >
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Descrição</label>
                <textarea
                    name="description" id="description"
                    class="w-full p-2 border rounded">{{ old('description', $service->description ?? '') }}</textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($service) ? 'Atualizar' : 'Salvar' }}
            </button>
        </form>
    </div>
    </x-admin-layout>
