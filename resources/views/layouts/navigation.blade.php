<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-neutral-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if(auth()->user()->role === 'warga')
                        <a href="{{ route('laporan.index') }}" class="flex items-center space-x-3 group">
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-semibold text-neutral-900 tracking-tight hidden sm:block">Lapor Cepat</span>
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-semibold text-neutral-900 tracking-tight hidden sm:block">Admin Panel</span>
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex md:items-center md:ml-10 md:space-x-2">
                    @if(auth()->user()->role === 'warga')
                        <a href="{{ route('laporan.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('laporan.index') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-neutral-700 hover:bg-neutral-100 hover:text-neutral-900' }}">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Laporan Saya
                            </span>
                        </a>
                        <a href="{{ route('laporan.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-0.5">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Laporan
                            </span>
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-neutral-700 hover:bg-neutral-100 hover:text-neutral-900' }}">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side - User Menu -->
            <div class="hidden md:flex md:items-center md:space-x-3">
                <!-- User Role Badge -->
                <div class="px-3 py-1.5 rounded-lg text-xs font-semibold
                    @if(auth()->user()->role === 'warga') bg-blue-100 text-blue-700 border border-blue-200
                    @elseif(auth()->user()->role === 'petugas') bg-green-100 text-green-700 border border-green-200
                    @else bg-purple-100 text-purple-700 border border-purple-200
                    @endif">
                    {{ ucfirst(auth()->user()->role) }}
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-neutral-100 transition-colors group">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="text-left hidden lg:block">
                                <div class="text-sm font-medium text-neutral-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-neutral-500">{{ Auth::user()->email }}</div>
                            </div>
                            <svg class="w-4 h-4 text-neutral-500 group-hover:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-neutral-200">
                            <p class="text-sm font-medium text-neutral-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-neutral-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Profile') }}
                            </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="flex items-center text-red-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Log Out') }}
                                </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="p-2 rounded-lg text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-neutral-200 bg-white/95 backdrop-blur-md">
        <div class="px-4 py-3 space-y-2">
            @if(auth()->user()->role === 'warga')
                <a href="{{ route('laporan.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('laporan.index') ? 'bg-blue-50 text-blue-700' : 'text-neutral-700 hover:bg-neutral-100' }}">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Laporan Saya
                    </span>
                </a>
                <a href="{{ route('laporan.create') }}" class="block px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg text-center shadow-sm">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan
                    </span>
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-neutral-700 hover:bg-neutral-100' }}">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard Admin
                    </span>
                </a>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div class="px-4 py-4 border-t border-neutral-200 bg-neutral-50">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-neutral-900 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-neutral-500 truncate">{{ Auth::user()->email }}</div>
                </div>
                <div class="px-2 py-1 rounded text-xs font-semibold
                    @if(auth()->user()->role === 'warga') bg-blue-100 text-blue-700
                    @elseif(auth()->user()->role === 'petugas') bg-green-100 text-green-700
                    @else bg-purple-100 text-purple-700
                    @endif">
                    {{ ucfirst(auth()->user()->role) }}
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100 rounded-lg transition-colors">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('Profile') }}
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            {{ __('Log Out') }}
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
