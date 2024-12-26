<div>
    <!-- Dropdown para selecionar o veículo pela placa -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <div class="mb-6">
            <label for="selectedVehicleId" class="block text-gray-700 uppercase dark:text-gray-200">Placa do Veículo</label>
            <select id="selectedVehicleId" name="selectedVehicleId" wire:model="selectedVehicleId" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500">
                <option value="">Selecione a placa do veículo</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->plate }} - {{ $vehicle->brand }} {{ $vehicle->model }}</option>
                @endforeach
            </select>
            @error('selectedVehicleId') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Campos preenchidos automaticamente com os dados do veículo selecionado -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="brand" class="block text-gray-700 uppercase dark:text-gray-200">Marca</label>
            <input type="text" id="brand" name="brand" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ $vehicleDetails->$vehicle->model['brand'] ?? '' }}" readonly>
        </div>

        <div>
            <label for="model" class="block text-gray-700 uppercase dark:text-gray-200">Modelo</label>
            <input type="text" id="model" name="model" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ $vehicle->model }}" readonly>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="year" class="block text-gray-700 uppercase dark:text-gray-200">Ano</label>
            <input type="text" id="year" name="year"  class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ $vehicleDetails['year'] ?? '' }}" readonly>
        </div>

        <div>
            <label for="odometer" class="block text-gray-700 uppercase dark:text-gray-200">Hodômetro</label>
            <input type="text" id="odometer" name="odometer" class="w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-500" value="{{ $vehicleDetails['odometer'] ?? '' }}" readonly>
        </div>

    </div>
</div>
