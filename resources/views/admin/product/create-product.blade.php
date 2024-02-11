<x-admin-layout>
    <div class="flex flex-row flex-wrap m-auto mt-6 px-6 py-5 shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{route('products.create')}}" class="lg:basis-5/12" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="mt-4 ">
                <label for="name">Product Name</label>
            <x-text-input type="text" class="block mt-1 w-full" id="name" name="name" placeholder="Product Name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>

            </div>

            <div class="mt-4 ">
                <label for="description">Product Description</label>
                <textarea class="block mt-1 w-full resize-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description" id="description" cols="30" rows="10"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>

            <div class="mt-4 ">
                <label for="price">Product Price</label>
            <x-text-input type="text" class="block mt-1 w-full" id="price" name="price" placeholder="Product Price"/>
            <x-input-error :messages="$errors->get('price')" class="mt-2"/>
            </div>

            <div class=" mt-4 mb-4 flex items-center justify-center w-full" id="product-photos">
                <label for="photos" class="flex flex-col items-center justify-center w-full h-20 border-2 border-indigo-800 rounded-lg cursor-pointer bg-indigo-700">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <p class="mb-2 text-xl text-gray-200"><span class="font-semibold">Click to upload Image</span></p>
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


        <form class="lg:basis-5/12 mx-5" action="{{route('categories.addproduct')}}" method="post">
            <div class="mt-4 ">
                <div>
                <label for="product_id">Product Id</label>
                <x-input-error :messages="$errors->get('product_id')" class="mt-2"/>
                <x-text-input class="block mt-1 w-full" type="text" name="product_id" id="product_id"/>
                </div>

                <label for="category_id">Category Name</label>
                   <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                <select name="category_id" id="category_id" class="block p-2.5 w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                    @php
                        foreach ($categories as $category):

                    @endphp
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @php
                        endforeach;
                    @endphp
                </select>
                <x-primary-button class="ms-4 mt-4">
                    @csrf
                    {{ __('Add category') }}
                </x-primary-button>
            </div>
        </form>

        <form class="lg:basis-5/12 mx-5" action="{{route('categories.removeproduct')}}" method="post">
            <div class="mt-4 ">

                <div id="product_id">
                <label for="product_id">Product Id</label>
                <x-input-error :messages="$errors->get('product_id')" class="mt-2"/>
                <x-text-input class="block mt-1 w-full" type="text" name="product_id" id="product_id"/>
                </div>

                <label for="category_id">Category Name</label>
                   <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                <select name="category_id" id="category_id" class="block p-2.5 w-full mt-1 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                    @php
                        foreach ($categories as $category):

                    @endphp
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @php
                        endforeach;
                    @endphp
                </select>
                <x-primary-button class="ms-4 mt-4">
                    @csrf
                    {{ __('Remove category') }}
                </x-primary-button>
            </div>
        </form>

        <form class="lg:basis-5/12 mx-5" action="{{route('products.addphoto')}}" method="post" enctype="multipart/form-data">
            <div class="mt-4 ">
                <div>
                    <label for="product_id">Product Id</label>
                    <x-input-error :messages="$errors->get('product_id')" class="mt-2"/>
                    <x-text-input class="block mt-1 w-full" type="text" name="product_id" id="product_id"/>
                </div>

                <div>
                    <label for="product_id">Order</label>
                    <x-input-error :messages="$errors->get('order')" class="mt-2"/>
                    <x-text-input class="block mt-1 w-full" type="text" name="order" id="order"/>
                </div>

                <div>
                    <label for="photo">Photo</label>
                    <x-input-error :messages="$errors->get('photo')" class="mt-2"/>
                    <input type="file" class="block mt-1 w-full" name="photo" id="photo"/>
                </div>


                </div>

                <x-primary-button class="ms-4 mt-4">
                    @csrf
                    {{ __('Add Photo') }}
                </x-primary-button>
            </div>
        </form>


        <form action="/file-upload"
      class="dropzone"
      id="my-awesome-dropzone"></form>
</div>

<script src="{{asset('js/admin/product/create-product.js')}}"></script>
</x-admin-layout>
