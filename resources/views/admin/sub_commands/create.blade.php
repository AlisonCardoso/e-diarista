<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">{{ __('Create Sub Command') }}</h1>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.sub_commands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-1 block w-full" required />
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Regional Command -->
            <div class="mb-4">
                <x-input-label for="regional_command_id" :value="__('Regional Command')" />
                <select name="regional_command_id" id="regional_command_id" class="mt-1 block w-full" required>
                    <option value="">{{ __('Select Regional Command') }}</option>
                    @foreach($regionalCommands as $regionalCommand)
                        <option value="{{ $regionalCommand->id }}" {{ old('regional_command_id') == $regionalCommand->id ? 'selected' : '' }}>
                            {{ $regionalCommand->name }}
                        </option>
                    @endforeach
                </select>
                @error('regional_command_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Imagem -->
            <div class="mb-4">
                <x-input-label for="image" :value="__('Image')" />
                <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500" accept="image/png, image/jpeg, image/jpg">
                @error('image')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.sub_commands.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    {{ __('Back to List') }}
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">
                    {{ __('Create Sub Command') }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
