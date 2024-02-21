<x-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Create a new category
                    </div>
                    <div class="mt-6 text-gray-500">
                        <form name="create-category" method="POST" action="{{route('categories.store')}}">
                            @csrf
                            <div class="mt-4">
                                <label for="name">Name</label>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="mt-4">
                                <label for="description">Description</label>
                                <textarea class="resize-none w-full border-gray-300 rounded-lg focus:ring-purple-600" name="description" >{{old('description')}}</textarea>
                            </div>
                            <div class="mt-4">
                                <label for="color">Color</label>
                                <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" type="text" data-coloris />
                            </div>

                            <div class="flex items
                            -center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Create') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts" >
        <script src="{{asset('js/admin/category/create-category.js')}}"></script>
    </x-slot>
</x-admin-layout>
