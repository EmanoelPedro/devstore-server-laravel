<x-admin-layout>
    <div id="confim-del-product-modal" class="hidden bg-black/50 h-full overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
        <div class="relative mx-auto top-[40%] p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <button type="button" class="del-product-modal-btn-confirm text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>

                    <button type="button" class="del-product-modal-btn-cancel modal-py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="px-12 py-10 m-5 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold">Products</h2>
        <div class="mt-4">
            <a href="{{route('admin.dashboard.products.create')}}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-light rounded-md text-md px-4 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600 dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">Create</a>
        </div>
        <div class="flex flex-row flex-wrap">
            @foreach($products as $product)
                <div class="w-full m-3 lg:basis-[calc(33.33%-1.5rem)] mb:basis-full sm:basis-[100%] md:basis-[100%] hover:shadow-lg bg-white border border-gray-200 rounded-lg shadow">
                    <a href="{{  route('admin.dashboard.products.edit',$product->id) }}">
                        <img src="{{ asset('storage/'.$product->photos->first()->path) }}">
                    </a>
                    <div class="mx-3">
                        <p class="text-gray-900 text-2xl font-medium">{{$product->name}}</p>
                        <p>U$ {{$product->price}}</p>
                    </div>
                    <div class="my-4 mx-3 ml-3">
                        <a href="{{route('admin.dashboard.products.edit', $product->id)}}" class="bg-blue-600 hover:bg-blue-700 text-white font-light rounded-md text-md px-4 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-blue-600 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-600">
                            edit</a>

                        <a href="#" data-product-id="{{$product->id}}" class="delete-product-btn bg-red-600 hover:bg-red-700 text-white font-light rounded-md text-md px-4 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-red-600 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-600">
                            Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{asset('js/admin/product/products.js')}}" type="module"></script>
    </x-slot>
</x-admin-layout>
