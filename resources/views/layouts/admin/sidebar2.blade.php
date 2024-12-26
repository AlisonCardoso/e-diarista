<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{  asset('img/logo_bprv.png') }}" width="55"alt="Logo bprv">
            <span class="mx-2 text-2xl font-semibold text-white">{{ __("Dashboard") }}</span>
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.dashboard') ? 'text-gray-100' : 'text-gray-500' }} bg-gray-700 bg-opacity-25" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-house"></i> <span class="mx-3">{{ __("Dashboard") }}</span>
        </a>
        
        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('products.create') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-600 hover:bg-opacity-35 hover:text-gray-100" href="{{ route('products.create') }}">
            <i class="fa-solid fa-dolly"></i>
            <span class="mx-3">{{ __("Products") }}</span>
        </a>
        
        <a class="flex items-center px-6 py-2 mt-4  uppercase {{ Route::currentRouteNamed('service_orders.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('service_orders.index') }}">
            <i class="fa-solid fa-folder-open"></i> <span class="mx-3">ordens de serviço</span>
        </a>


        <a class="flex items-center px-6 py-2 mt-4 uppercase {{ Route::currentRouteNamed('vehicles.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('vehicles.index') }}">
            <i class="fa-solid fa-car"></i>  <span class="mx-3">{{ __("Vehicles") }}</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 uppercase {{ Route::currentRouteNamed('workshops.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('workshops.index') }}">
            <i class="fa-solid fa-warehouse"></i> <span class="mx-3">{{ __("Workshop") }}</span>
        </a>

        <div class="relative group ">
            <button id="dropdown-button" class="flex items-center px-6 py-2 mt-4 uppercase {{ Route::currentRouteNamed('admin.users.index') || Route::currentRouteNamed('admin.roles.index') || Route::currentRouteNamed('admin.permissions.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <i class="fa-solid fa-gear"></i>
                <span class="mx-3 ">{{ __("Configurations") }}</span>
            </button>
            <div id="dropdown-menu" class=" dropdown_branding w-full">
                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.users.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.users.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="mx-3">{{ __("User") }}</span>
                </a>
                <div id="dropdown-menu" class=" dropdown_branding w-full">
                    <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.sub_commands.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.sub_commands.index') }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="mx-3">{{ __("Batalhão") }}</span>
                    </a>
    

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.roles.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.roles.index') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>

                    <span class="mx-3">{{ __("Role") }}</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.permissions.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.permissions.index') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>

                    <span class="mx-3">{{ __("Permissions") }}</span>
                </a>
            </div>
        </div>

    </nav>
</div>
<script>
    // JavaScript to toggle the dropdown
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    let isOpen = true; 

  
    function toggleDropdown() {
        isOpen = !isOpen;
        dropdownMenu.classList.toggle('hidden', !isOpen);
    }

   
    toggleDropdown();

    dropdownButton.addEventListener('click', () => {
        toggleDropdown();
    });
</script>
