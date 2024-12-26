<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center">
        <!-- Botão para abrir o menu lateral (hamburguer) em telas pequenas -->
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <!-- Botão de tema -->
    <div class="relative mx-4 lg:mx-0">
        <button id="theme-toggle" class="p-2">
            🌙
        </button>
    </div>

    <div class="flex items-center space-x-4">
        <!-- Botão de notificações -->
        <div x-data="{ notificationOpen: false }" class="relative">
            <button @click="notificationOpen = ! notificationOpen" class="flex text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <!-- Notificações -->
            <div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

            <div x-cloak x-show="notificationOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80" style="width:20rem;">
                <!-- Conteúdo de notificações aqui -->
            </div>
        </div>

        <!-- Menu do usuário -->
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = ! dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div class="showPhoto">
                    <div id="imagePreview" class="w-10 h-10 rounded-full overflow-hidden bg-gray-200">
                        <!-- Imagem do usuário com tamanho adaptável -->
                        <img src="{{ Auth::user()->image ? asset('uploads/' . Auth::user()->image) : asset('img/avatar.png') }}" alt="Imagem do Usuário" class="object-cover w-full h-full">
                    </div>
                </div>
                <div class="ml-2">{{ explode(' ', Auth::user()->name)[0] }}</div>
                <svg class="w-4 ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#545454" stroke-width="0.00024000000000000003">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z" fill="#5c5c5c"></path>
                </svg>
            </button>

            <!-- Dropdown do usuário -->
            <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

            <div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">{{ __("Setting") }}</a>
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __("Log Out") }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Estilos para responsividade -->
<style>
    @media (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: flex-start;
        }
        .flex {
            width: 100%;
            justify-content: space-between;
        }
        .showPhoto img {
            width: 32px; /* Reduzindo o tamanho da foto em telas menores */
            height: 32px;
        }
    }

    @media (max-width: 480px) {
        .showPhoto img {
            width: 28px; /* Ajustando ainda mais a imagem em telas muito pequenas */
            height: 28px;
        }
        .ml-2 {
            display: none; /* Ocultando o nome em dispositivos muito pequenos */
        }
    }
</style>
