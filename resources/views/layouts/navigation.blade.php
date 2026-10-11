<nav x-data="{ open: false }" class="bg-[#003876] border-b-4 border-[#8cc63f] shadow-lg sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                
                <!-- Logo Oficial -->
                <div class="shrink-0 flex items-center bg-white px-4 py-2 rounded-b-2xl shadow-md h-full">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/logo-ct.png') }}" alt="Logo CT Olof Palme" class="block h-14 w-auto object-contain">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex h-full items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-4 {{ request()->routeIs('dashboard') ? 'border-[#8cc63f] text-[#8cc63f]' : 'border-transparent text-white hover:text-[#8cc63f] hover:border-[#8cc63f]' }} text-lg font-bold leading-5 transition duration-150 ease-in-out h-full mt-1">
                        {{ __('Panel Principal') }}
                    </a>
                    <a href="{{ route('carreras.index') }}" class="inline-flex items-center px-1 pt-1 border-b-4 {{ request()->routeIs('carreras.*') ? 'border-[#8cc63f] text-[#8cc63f]' : 'border-transparent text-white hover:text-[#8cc63f] hover:border-[#8cc63f]' }} text-lg font-bold leading-5 transition duration-150 ease-in-out h-full mt-1">
                        {{ __('Especialidades') }}
                    </a>
                    <a href="{{ route('interesados.index') }}" class="inline-flex items-center px-1 pt-1 border-b-4 {{ request()->routeIs('interesados.*') ? 'border-[#8cc63f] text-[#8cc63f]' : 'border-transparent text-white hover:text-[#8cc63f] hover:border-[#8cc63f]' }} text-lg font-bold leading-5 transition duration-150 ease-in-out h-full mt-1">
                        {{ __('Prospectos') }}
                    </a>
                    
                    <a href="{{ route('inicio') }}" target="_blank" class="inline-flex items-center ml-4 px-4 py-2 bg-[#0089D0] border border-transparent rounded-full font-bold text-xs text-white uppercase tracking-widest hover:bg-[#8cc63f] transition ease-in-out duration-150 shadow-md">
                        Ver Sitio Web
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-full text-[#003876] bg-white hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150 shadow-md">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1 text-[#8cc63f]">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="font-bold text-red-600 hover:text-red-800 hover:bg-red-50">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[#8cc63f] hover:bg-[#002652] focus:outline-none focus:bg-[#002652] focus:text-[#8cc63f] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold text-[#003876]">
                {{ __('Panel Principal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('carreras.index')" :active="request()->routeIs('carreras.*')" class="font-bold text-[#003876]">
                {{ __('Especialidades') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('interesados.index')" :active="request()->routeIs('interesados.*')" class="font-bold text-[#003876]">
                {{ __('Prospectos') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-50">
            <div class="px-4 flex items-center gap-3">
                <div class="bg-[#0089D0] text-white rounded-full w-10 h-10 flex items-center justify-center font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-[#003876]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="font-bold text-red-600">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>