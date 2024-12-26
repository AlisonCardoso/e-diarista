<div>
    <div class="mt-4">
        <label for="regional_command_id" class="block font-medium text-sm text-gray-700 dark:text-gray-200">
            COMANDO REGIONAL
        </label>
        <select wire:model.live="regional_commandId" wire:change="filterSubCommandById"
                name="regional_command_id" id="regional_command_id"
                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
            <option selected>Selecione um CRPM</option>
            @foreach ($regional_commands as $command)
                <option value="{{$command->id}}">{{$command->name}}</option>
            @endforeach
        </select>
    </div>

    @if ($sub_commands)
        <div class="mt-4">
            <label for="sub_command_id" class="block font-medium text-sm text-gray-700 dark:text-gray-200">
                BATALHÃO DE POLICIA MILITAR
            </label>
            <select wire:model.live="sub_command_id"
                    name="sub_command_id" id="sub_command_id"
                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                <option value="">Selecione o Batalhão</option>
                @foreach ($sub_commands as $sub_command)
                    <option value="{{ $sub_command->id }}" {{ old('sub_command_id') == $sub_command->id ? 'selected' : '' }}>
                        {{ $sub_command->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
</div>

