<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="px-12 py-10 m-5 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold">Categories</h2>
        <div class="mt-4">
            <a href="{{route('admin.dashboard.categories.create')}}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-light rounded-md text-md px-4 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600 dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">Create</a>
        </div>
        <div>
            <table class="min-w-full mt-4">
                <thead>
                <tr>
                    <th class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider mb:hidden">
                        Color
                    </th>
                    <th class="px-4 py-3 border-b-2 border-gray-300"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr  data-category-id="{{$category->id}}" class="mx-10">
                        <td class="px-4 py-4">
                            {{$category->name}}
                        </td>

                        <td class="px-4 py-4 whitespace-normal mb:px-2">
                            {{$category->description}}
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap mb:hidden">
                            {{$category->color}}
                        </td>

                        <td>
                            <a href="{{route('admin.dashboard.categories.edit', $category->id)}}"
                               class="bg-purple-600 hover:bg-purple-700 text-white font-light rounded-md text-md px-4 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600">Edit</a>
                        </td>

                        <td>
                            <form method="post" action="{{route('categories.destroy')}}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <button type="submit"
                                        class="delete bg-red-600 hover:bg-red-700 text-white font-light rounded-md text-md px-4 py-2 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
            @endforeach
        </div>
    </div>

    <x-slot name="scripts" >
        <script src="{{asset('js/admin/category/categories.js')}}"></script>
    </x-slot>
</x-admin-layout>
