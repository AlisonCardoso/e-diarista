
<div>

    <div class="mt-4">

        <label for="category_id"class="block font-medium text-sm text-gray-700 dark:text-gray-200">
        Categoria
        </label>
        <select wire:model.live="category_id" wire:change="filterSubCategory"
                name="category_id" id="category_id"
                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" >
        <option selected>Selecione uma Categoria</option>
        @foreach ($category->all() as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            </select>
    </div>

    @if ($sub_categories)

        <div class="mt-4">
            <label for="sub_category_id" class="block font-medium text-sm text-gray-700 dark:text-gray-200">
                Sub-Categoria
            </label>
            <select  wire:model="sub_category_id"
                     name="sub_category_id"  id="sub_category_id"
                     class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" >
                <option value="">Selecione sub-categoria</option>
                @foreach ($sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}" {{ old('sub_category_id') == $sub_category->id ? 'selected' : '' }}> {{ $sub_category->name }}</option>
                @endforeach
            </select>

        </div>
    @endif
</div>



