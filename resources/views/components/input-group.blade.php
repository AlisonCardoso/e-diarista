@props(['label', 'id', 'name'])

<div class="mt-4">
    <x-input-label :for="$id" :value="$label" />
    <x-text-input 
        :id="$id" 
        class="block mt-1 w-full" 
        type="text" 
        :name="$name" 
        :value="old($name)" 
        required autofocus autocomplete="{{ $name }}" 
    />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
