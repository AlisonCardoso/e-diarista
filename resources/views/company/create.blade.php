<x-admin-layout>
<div class="container">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-200 dark:bg-slate-800 p-6 rounded-lg shadow-md w-1/2 mt-5">


        @if (session()->has('success'))
             <span class="text-green-500 my-3">{{ session('success') }}</span>
        @endif

        <div class="card-body">

    <form class="row g-3" method="post" action="@if (isset($edit->id)) {{ route('companies.update', ['id' => $edit->id]) }}
                    @else{{ route('companies.store') }} @endif" enctype="multipart/form-data">
                    @csrf

                     @livewire('CreateCompany')




      <div class="mt-4">
        <x-input-label for="name" :value="__('Nome da Companhia') " />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="slug" :value="__(' Nome Abreviado Ex: 6ªCIA/2ºPel/PRv_União') " />
        <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required autofocus autocomplete="slug" />
        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>
     <!-- Nome da oficina-->
     <div class="mt-4">
        <x-input-label for="pelotao" :value="__(' PELOTÃO/POSTO') " />
        <x-text-input id="pelotao" class="block mt-1 w-full" type="text" name="pelotao" :value="old('pelotao')" required autofocus autocomplete="pelotao" />
        <x-input-error :messages="$errors->get('pelotao')" class="mt-2" />
    </div>



    <div class="mt-6 flex justify-end">
        <x-secondary-button href="{{ route('companies.index') }}">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-primary-button class="ms-3">
            {{ __('Save') }}
        </x-primary-button>
    </div>
        </form>


            </div>
                </div>
            </div>

        </div>

                </div>
            </div>
        </div>
    </div>



</x-admin-layout>





















