<x-app-layout>

    <div class="flex max-w-full flex-row justify-center md:h-[600px] md:container md:mx-auto mb:flex-col mb:px-4 mb:mx-auto">
        <div class="md:basis-1/2 sm:basis-1/2">
            @foreach ($photos as $photo)
                <img class="rounded-lg shadow h-full w-[600px]" src="{{$photo->url}}" alt="{{$photo->name}}"/>
            @endforeach
        </div>

        <div class=" flex flex-col md:justify-center md:w-[600px] md:my-0 mb:my-5 sm:basis-1/2 sm:mx-5">
            <h1 class="text-3xl text-gray-900 sm:text-2xl mb:mb-5 sm:mb-5">{{$product->name}}</h1>
            <div class="">
                <p class="text-xl sm:text-lg text-gray-900 mb:mb-5 sm:mb-5">{{$product->description}}</p>
            </div>
            <div>
                <p class="text-2xl text-gray-900">U$ {{$product->price}}</p>
            </div>
            <div class="my-5">
                <label for="quantity" class="text-lg mr-3 text-gray-800">Quantity</label>
                <select name="quantity" id="quantity"
                        class="border-gray-300 focus:border-purple-600 focus:ring-purple-600 rounded-md shadow-sm">
                    @for($i=1; $i <= 5; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-5">
                <button
                    class="text-purple-600 bg-none border border-purple-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-600 hover:text-white focus:ring-1 focus:ring-offset-1 focus:outline-none focus:ring-purple-600 dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">
                    Add to cart
                </button>
                <a href="{{back()}}" title="Back"
                   class="px-5 py-2.5 rounded-md text-white bg-gray-500 hover:bg-gray-400 ">Back</a>
            </div>
        </div>
    </div>

</x-app-layout>
