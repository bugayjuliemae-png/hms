<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="text-xl font-bold text-blue-600">
                            🏨 HMS
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                    >
                        Dashboard
                    </a>

                    @auth

                        {{-- ADMIN MENU --}}
                        @if(auth()->user()->role === 'admin')

                            <a
                                href="{{ route('users.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                User Management
                            </a>

                            <a
                                href="{{ route('rooms.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                Room Management
                            </a>

                            <a
                                href="{{ route('bookings.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                Reservations
                            </a>

                        @endif


                        {{-- STAFF MENU --}}
                        @if(auth()->user()->role === 'staff')

                            <a
                                href="{{ route('staff.dashboard') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                Staff Dashboard
                            </a>

                        @endif


                        {{-- CUSTOMER MENU --}}
                        @if(auth()->user()->role === 'user')

                            <a
                                href="{{ route('customer.dashboard') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                My Dashboard
                            </a>

                            <a
                                href="{{ route('bookings.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                My Reservations
                            </a>

                            <a
                                href="{{ route('bookings.create') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:border-gray-300"
                            >
                                Book a Room
                            </a>

                        @endif

                    @endauth

                </div>
            </div>


            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth

                    <!-- User Name -->
                    <div class="me-4 text-sm text-gray-600">
                        {{ auth()->user()->name }}
                    </div>

                    <!-- Profile -->
                    <a
                        href="{{ route('profile.edit') }}"
                        class="me-4 text-sm text-gray-600 hover:text-blue-600"
                    >
                        Profile
                    </a>

                    <!-- LOGOUT -->
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
                        >
                            Log Out
                        </button>
                    </form>

                @endauth

            </div>


            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
                >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden"
    >

        <div class="pt-2 pb-3 space-y-1">

            <a
                href="{{ route('dashboard') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
                Dashboard
            </a>


            @auth

                {{-- ADMIN MOBILE MENU --}}
                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('users.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        User Management
                    </a>

                    <a
                        href="{{ route('rooms.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Room Management
                    </a>

                    <a
                        href="{{ route('bookings.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Reservations
                    </a>

                @endif


                {{-- STAFF MOBILE MENU --}}
                @if(auth()->user()->role === 'staff')

                    <a
                        href="{{ route('staff.dashboard') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Staff Dashboard
                    </a>

                @endif


                {{-- CUSTOMER MOBILE MENU --}}
                @if(auth()->user()->role === 'user')

                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        My Dashboard
                    </a>

                    <a
                        href="{{ route('bookings.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        My Reservations
                    </a>

                    <a
                        href="{{ route('bookings.create') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Book a Room
                    </a>

                @endif

            @endauth

        </div>


        <!-- Mobile User Information -->
        @auth

            <div class="pt-4 pb-4 border-t border-gray-200">

                <div class="px-4">

                    <div class="font-medium text-base text-gray-800">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="font-medium text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </div>

                </div>


                <div class="mt-3 space-y-1">

                    <!-- Profile -->
                    <a
                        href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Profile
                    </a>


                    <!-- MOBILE LOGOUT -->
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="px-4 mt-2"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
                        >
                            Log Out
                        </button>
                    </form>

                </div>

            </div>

        @endauth

    </div>

</nav>