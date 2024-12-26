<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">{{ __('Sub Commands') }}</h1>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <!-- Botão de criação -->
        <a href="{{ route('admin.sub_commands.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">
            {{ __('Create New Sub Command') }}
        </a>

        <!-- Tabela de SubCommands -->
        <table class="table-auto w-full mt-4 border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">{{ __('Name') }}</th>
                    <th class="px-4 py-2">{{ __('Slug') }}</th>
                    <th class="px-4 py-2">{{ __('Regional Command') }}</th>
                    <th class="px-4 py-2">{{ __('Image') }}</th>
                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCommands as $subCommand)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $subCommand->name }}</td>
                        <td class="px-4 py-2">{{ $subCommand->slug }}</td>
                        <td class="px-4 py-2">{{ $subCommand->regional_command->slug ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            @if($subCommand->image)
                                <img src="{{ asset('uploads/sub_commands/' . $subCommand->image) }}" alt="Image" width="50" class="rounded-md">
                            @else
                                {{ __('No Image') }}
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.sub_commands.edit', $subCommand) }}" class="text-blue-500 hover:text-blue-700">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.sub_commands.destroy', $subCommand) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
