@php
    $isLogged = \Illuminate\Support\Facades\Auth::check();
    $categories = \App\Models\Category::all();

    $cartNumItems = 0;
    if($isLogged){
    $user = \Illuminate\Support\Facades\Auth::user();
    $cart = \Illuminate\Support\Facades\Auth::user()->carts()->where('status', 'open')->first();
    $cartNumItems = $cart->products()->count();
}
@endphp
<nav x-data="{ open: false }" class="max-w-full bg-white mb-6 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="py-2 lg:container lg:m-auto mb:px-4 mb:mx-auto">
        <div class="flex justify-between">

            <!-- Logo -->
            <div class="shrink-0 flex items-center sm:me-6">
                <a href="{{ route('site.home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="shrink-1 flex flex-row items-center px-4 basis-full mb:hidden">
                <form action="" class="flex flex-row basis-full items-center">
                    <input type="text"
                           class="basis-full rounded-l-md text-md text-gray-100 px-6 h-10 border-r-0 border-gray-300 peer focus:ring-purple-600"
                           placeholder="Search for product">
                    <button type="submit"
                            class="icon-search text-2xl px-2 rounded-r-md h-10 border border-l-0 border-gray-300 bg-purple-600 focus:ring-purple-600 peer-focus:ring-purple-600"></button>
                </form>
            </div>

            <div class="flex justify-end">
                <!-- Cart -->
                <div class="flex flex-row justify-center items-center sm:ms-6 ml-0">

                    <span
                        class="{{($cartNumItems) ? '' : 'hidden ' }}cart-icon-products-quantity block text-white text-center text-sm bg-purple-600 rounded-full w-[20px] h-[20px] mt-1 mr-[-5px]">{{$cartNumItems}}</span>
                    <a href="{{route('cart.show')}}"
                       class="cart-icon-products icon-shopping-cart text-3xl hover:text-purple-800"></a>
                </div>
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                @if($isLogged)
                                    <x-dropdown-link
                                        :href="route('profile.edit')"> {{Auth::user()->first_name}} </x-dropdown-link>
                                @else
                                    <x-dropdown-link :href="route('login')">Fazer login</x-dropdown-link>
                                @endif

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        @if (Auth::check())
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        @else
                            <x-slot name="content">
                                <x-dropdown-link :href="route('login')">
                                    {{ __('login') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <x-dropdown-link :href="route('register')">
                                    {{ __('register') }}
                                </x-dropdown-link>
                            </x-slot>
                        @endif
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class=" flex items-center sm:hidden ms-3">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden absolute z-10 bg-gray-100 w-full">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->first_name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800"><a href="{{route('login')}}">Fazer login</a></div>
                </div>
            @endif

            <div class="px-4">
                <div class="pt-2 pb-3 space-y-1 border-t-4 border-gray-300">
                    <x-responsive-nav-link :href="route('site.home')" :active="request()->routeIs('site.home')">
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('categories.index')"
                                           :active="request()->routeIs('categories.index')">
                        {{ __('Categories') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-purple-600 shadow md:px-12">
        <div class=" flex flex-row mx-auto py-3 lg:container lg:m-auto mb:px-4 mb:mx-auto">
{{--            <x-dropdown align="left">--}}
{{--                <x-slot name="trigger">--}}
{{--                    <button--}}
{{--                        class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-none hover:text-gray-100 focus:outline-none transition ease-in-out duration-150">--}}
{{--                        Clothing--}}
{{--                        <div class="ms-1">--}}
{{--                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                <path fill-rule="evenodd"--}}
{{--                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"--}}
{{--                                      clip-rule="evenodd"/>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </button>--}}

{{--                </x-slot>--}}
{{--                <x-slot name="content">--}}
{{--                    <x-dropdown-link :href="route('categories.index')">All Categories</x-dropdown-link>--}}
{{--                    <x-dropdown-link :href="route('categories.index')">T-rat</x-dropdown-link>--}}
{{--                    <x-dropdown-link :href="route('categories.index')">Sweatshirts</x-dropdown-link>--}}
{{--                </x-slot>--}}
{{--            </x-dropdown>--}}
            @foreach($categories as $category)
                <a class="inline-flex items-center px-2 py-2 border border-transparent text-xl leading-4 font-medium rounded-md text-black bg-none hover:text-gray-100 focus:outline-none transition ease-in-out duration-150"  href="{{route('categories.show',$category->slug)}}">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
</nav>
