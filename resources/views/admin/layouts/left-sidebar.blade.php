@php
    $navigation = [
        [
            'name' => 'Dashboard',
            'icon' => 'tachometer',
            'route' => 'admin.dashboard.home',
            'active' => request()->routeIs('admin.dashboard.home'),
        ],
        [
            'name' => 'Products',
            'icon' => 'archive',
            'route' => 'admin.dashboard.products.index',
            'active' => request()->routeIs('products.index'),
        ],
        [
            'name' => 'Categories',
            'icon' => 'list-thumbnails',
            'route' => 'admin.dashboard.categories.index',
            'active' => request()->routeIs('admin.dashboard.categories.index'),
        ],
//        [
//            'name' => 'Customers',
//            'icon' => 'users',
//            'route' => 'customers',
//            'active' => request()->routeIs('customers'),
//        ],
//        [
//            'name' => 'Settings',
//            'icon' => 'cog',
//            'route' => 'settings',
//            'active' => request()->routeIs('settings'),
//        ],
    ];

@endphp
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach($navigation as $item)
                <li>
                    <a href="{{route($item['route'])}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$item['active'] ? 'bg-gray-100 dark:bg-gray-700' : ''}} icon-{{$item['icon']}}">
                        <span class="ms-3">{{$item['name']}}</span>
                    </a>
                </li>

            @endforeach
        </ul>
    </div>
</aside>
