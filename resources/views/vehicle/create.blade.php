<x-admin-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 dark:bg-slate-800">
        <div class="bg-gray-200 dark:bg-slate-900 p-6 rounded-lg shadow-md w-full sm:w-3/4 lg:w-2/3 xl:w-1/2 mt-5">
            <x-alert />

            <!-- Botão de Cancelar -->
            <div class="flex justify-start mb-4">
                <a href="{{ route('vehicles.index') }}" 
                   class="mr-2 py-2 px-4 text-white bg-gray-500 hover:bg-gray-700 rounded-lg uppercase font-bold">
                    <i class="fa-solid fa-circle-left"></i> Cancelar</a>
            </div>

            <form method="POST"
                  action="{{ isset($vehicle) ? route('vehicles.update', $vehicle) : route('vehicles.store') }}"
                  enctype="multipart/form-data">
                @csrf

                @if (isset($vehicle))
                    @method('PUT')
                @endif

                 <!-- Campos do Formulário com Três Colunas -->
                 {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6"> --}}
                      @livewire('create-company')
                 

                 

                      <div class="flex space-x-2">
                       
                        <div class="w-1/2">
                        <label for="type_vehicle_id" 
                        class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">TIPO DO VEÍCULO</label>
                        <select id="type_vehicle_id" name="type_vehicle_id" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>TIPO DE VEÍCULO</option>
                            @foreach ($type_vehicle->all() as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('type_vehicle_id', $edit->type_vehicle_id ?? '') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Situação do Veículo -->
                    <div class="w-1/2">
                        <label for="situation_vehicle_id" 
                        class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">SITUAÇÃO DO VEÍCULO</label>
                        <select name="situation_vehicle_id" id="situation_vehicle_id" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm uppercase rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>SITUAÇÃO DO VEÍCULO</option>
                            @foreach ($situation_vehicle->all() as $situation)
                                <option value="{{ $situation->id }}"
                                    {{ old('situation_vehicle_id', $edit->situation_vehicle_id ?? '') == $situation->id ? 'selected' : '' }}>
                                    {{ $situation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
   <!-- Campos do Formulário com Três Colunas -->
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
    
                    <div>
                        <x-input-label for="brand" :value="__('Marca:')" />
                        <x-text-input id="brand" class="block mt-2 w-full" type="text" name="brand" :value="old('brand', $vehicle->brand ?? '')" required autofocus autocomplete="brand" />
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <!-- Modelo -->
                    <div>
                        <x-input-label for="model" :value="__('Modelo:')" />
                        <x-text-input id="model" class="block mt-2 w-full" type="text" name="model" :value="old('model', $vehicle->model ?? '')" required autofocus autocomplete="model" />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Prefixo -->
                    <div>
                        <x-input-label for="prefix" :value="__('Prefixo')" />
                        <x-text-input id="prefix" class="block mt-2  w-full" type="text" name="prefix" :value="old('prefix', $vehicle->prefix ?? '')" required autofocus autocomplete="prefix" />
                        <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
                    </div>

                    <!-- Placa -->
                    <div>
                        <x-input-label for="plate" :value="__('Placa:')" />
                        <x-text-input id="plate" class="block mt-2 w-full" x-mask="aaa-9*99" placeholder="AAA-9A99" type="text" name="plate" :value="old('plate', $vehicle->plate ?? '')" required autofocus autocomplete="plate" />
                        <x-input-error :messages="$errors->get('plate')" class="mt-2" />
                    </div>

                    <!-- Número de Patrimônio -->
                    <div>
                        <x-input-label for="asset_number" :value="__('Número de Patrimônio')" />
                        <x-text-input id="asset_number" class="block mt-2 w-full" type="text" name="asset_number" :value="old('asset_number', $vehicle->asset_number ?? '')" />
                        <x-input-error :messages="$errors->get('asset_number')" class="mt-2" />
                    </div>

                    <!-- Caracterização da Viatura -->
                    <div>
                        <label for="characterized" class="block font-medium text-sm text-gray-700 dark:text-gray-200">
                            Plotagem da Viatura:
                        </label>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="characterized" name="characterized" value="1" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                            {{ old('characterized', $vehicle->characterized ?? false) ? 'checked' : '' }}>
                            <label for="characterized" class="ml-2 text-sm text-gray-700 dark:text-gray-200">
                                Caracterizada
                            </label>
                        </div>
                        @if ($errors->has('characterized'))
                            <span class="text-red-500 text-sm">{{ $errors->first('characterized') }}</span>
                        @endif
                    </div>

                    <!-- Hodômetro -->
                    <div>
                        <x-input-label for="odometer" :value="__('Hodômetro')" />
                        <x-text-input id="odometer" class="block mt-2 w-full" type="text" name="odometer" :value="old('odometer', $vehicle->odometer ?? '')" />
                        <x-input-error :messages="$errors->get('odometer')" class="mt-2" />
                    </div>

                    <!-- Ano -->
                    <div>
                        <x-input-label for="year" :value="__('Ano')" />
                        <x-text-input id="year" class="block mt-2 w-full" type="text" name="year" :value="old('year', $vehicle->year ?? '')" required autofocus autocomplete="year" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <!-- Preço -->
                    <div>
                        <x-input-label for="price" :value="__('Preço:')" />
                        <x-text-input id="price" class="block mt-2 w-full" type="text" x-mask:dynamic="$money($input, ',')" name="price" :value="old('price', $vehicle->price ?? '')" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                </div>
                <!-- Botões de Ação -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('vehicles.index') }}" class="mr-2 py-2 px-4 text-white bg-gray-500 hover:bg-gray-700 rounded-lg uppercase font-bold">
                        <i class="fa-solid fa-circle-left"></i> Cancelar
                    </a>
                    <button type="submit" class="py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg uppercase font-bold">
                        {{ isset($vehicle) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function money(input) {
            return input.startsWith('8') ? '999.999,99' : input; // Exemplo para máscara de dinheiro
        }
    </script>
</x-admin-layout>
