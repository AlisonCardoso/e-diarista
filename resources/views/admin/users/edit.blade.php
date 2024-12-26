<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold"> 
            {{ isset($user) ? __("Edit User") : __("Create User") }}
        </h1>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <!-- Formulário de criação/edição -->
        <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <!-- Campo para nome -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo para senha -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <input type="password" id="password" name="password" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <!-- Confirmar senha -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Campo para a imagem -->
            <div class="mb-5">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Photo</label>
                <div class="flex items-center">
                    <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg" 
                        class="block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:bg-gray-50 hover:file:bg-gray-100"
                        onchange="previewImage(this)" />
                </div>
                <div class="mt-2">
                    <div id="imagePreview" 
                         class="w-32 h-32 bg-cover bg-center rounded-full border-2 border-gray-300" 
                         style="background-image: url('{{ isset($user) && $user->image ? url('/uploads/' . $user->image) : url('/img/avatar.png') }}');"></div>
                </div>
                @error('image')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para roles -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Roles</label>
                @foreach($roles as $role)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" 
                            {{ isset($user) && in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : (in_array($role->id, old('roles', [])) ? 'checked' : '') }}
                            class="mr-2">
                        <label for="role_{{ $role->id }}" class="text-sm text-gray-900 dark:text-gray-100">{{ $role->name }}</label>
                    </div>
                @endforeach
                @error('roles')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botões de ação -->
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    Voltar para lista
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ isset($user) ? __("Update User") : __("Create User") }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

<script>
    function previewImage(input) {
        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
        }
        reader.readAsDataURL(file);
    }
</script>
