<header>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="w-[5%]">
                <h1 class="w-full   h-full">
                    <a wire:navigate href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('/assets/images/logo.png') }}" class="w-full h-full object-contain"
                            alt="Logo" />

                    </a>
                </h1>
            </div>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">


                    <li>
                        <a wire:navigate href="{{ route('home') }}"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 {{ request()->routeIs('home') ? 'md:text-blue-700' : '' }}  md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                    @auth
                        <li>
                            <a wire:navigate href="{{ route('index.shop') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent  {{ request()->routeIs('index.shop') ? 'md:text-blue-700' : '' }} md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Shop
                            </a>
                        </li>
                        @auth
                            @role(['superAdmin', 'admin'])
                                <li>
                                    <a wire:navigate href="{{ route('index.user') }}"
                                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent  {{ request()->routeIs('index.user') ? 'md:text-blue-700' : '' }} md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">User
                                    </a>
                                </li>
                                @role('superAdmin')
                                
                                    <li>
                                        <a wire:navigate href="{{ route('index.maintanance') }}"
                                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent  {{ request()->routeIs('index.maintanance') ? 'md:text-blue-700' : '' }} md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Maintenance
                                        </a>
                                    </li>
                                @endrole
                            @endauth
                        @endrole
                        <li>
                            <livewire:auth.logout />
                        </li>
                    @else
                        <li>
                            <a wire:navigate href="{{ route('login') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 {{ request()->routeIs('login') ? 'md:text-blue-700' : '' }}  md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('register') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent  {{ request()->routeIs('register') ? 'md:text-blue-700' : '' }} md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


</header>
