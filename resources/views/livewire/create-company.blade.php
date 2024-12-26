<div class="flex space-x-2">
    <!-- Comando Regional -->
    <div class="w-1/2">
        <label for="regional_command_id" 
        class="block mt-2 font-medium text-sm text-gray-700 dark:text-gray-200">
            COMANDO REGIONAL
        </label>
        <select wire:model.live="regional_command_id" wire:change="filterSubCommandById"
                name="regional_command_id" id="regional_command_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>SELECIONE O CRPM</option>
            @foreach ($regional_command->all() as $command)
                <option value="{{$command->id}}">{{$command->name}}</option>
            @endforeach
        </select>
    </div>

    <!-- Batalhão de Polícia Militar -->
    @if ($sub_commands)
        <div class="w-1/2">
            <label for="sub_command_id" class="block mt-2 font-medium text-sm text-gray-700 dark:text-gray-200">
                BATALHÃO DE POLÍCIA MILITAR
            </label>
            <select wire:model.live="sub_command_id"
                    name="sub_command_id" id="sub_command_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">SELECIONE O BATALHÃO</option>
                @foreach ($sub_commands as $sub_command)
                    <option value="{{ $sub_command->id }}" {{ old('sub_command_id') == $sub_command->id ? 'selected' : '' }}>
                        {{ $sub_command->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
</div>
