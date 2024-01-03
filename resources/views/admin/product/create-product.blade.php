<x-app-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{route('products.create')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="mt-4 ">
                <label for="name">Product Name</label>
            <x-text-input type="text" class="block mt-1 w-full" id="name" name="name" placeholder="Product Name"/>
            </div>
            <div class="mt-4 ">
                <label for="description">Product Description</label>
                <textarea class="block mt-1 w-full" name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            <div class="mt-4 ">
                <label for="price">Product Price</label>
            <x-text-input type="text" class="block mt-1 w-full" id="price" name="price" placeholder="Product Price"/>
            </div>

            <div class=" mt-4 mb-4 flex items-center justify-center w-full">
                <label for="photos" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="photos" type="file" name="photos" class="hidden" />
                </label>
            </div> 

            <div class="mt-4 ">
                <select name="status" id="status" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="draft">draft</option>
                    <option value="published">published</option>
                </select>
            </div>
            <div>
                <x-primary-button class="ms-4 mt-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>

    </div>




    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{route('products.addphoto')}}" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="mt-4 ">
                <label for="photo">Photo</label>
            <x-text-input type="file" class="block mt-1 w-full" id="photo" name="photo" placeholder="Photo"/>
            </div>

            <div class="mt-4 ">
                <label for="product_id">Product Id</label>
            <x-text-input type="text" class="block mt-1 w-full" id="product_id" name="product_id" placeholder="Product Id"/>
            </div>

            <div class="mt-4">
                <label for="order">Image Order</label>
            <x-text-input type="text" class="block mt-1 w-full" id="order" name="order" placeholder="Image Order"/>
            </div>

            <div>
                <x-primary-button class="ms-4 mt-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>