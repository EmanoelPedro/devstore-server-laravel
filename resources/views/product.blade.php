@php
    $onCart = auth()->check() && auth()->user()->carts()->where('status', 'open')->first()->products()->get()->contains($product->id);
   $quantityInCart = 0;
   if ($onCart) {
        $quantityInCart = auth()->user()->carts()->where('status', 'open')->first()->products()->get()->find($product->id)->pivot->quantity;
    }
@endphp

<x-app-layout>

    <div
        class="flex max-w-full flex-row justify-center md:h-[600px] md:container md:mx-auto mb:flex-col mb:px-4 mb:mx-auto">
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
{{--            <div class="my-5">--}}

{{--                <div class="w-[300px] flex flex-row items-center">--}}
{{--                    <label for="quantity" class="text-lg mr-3 text-gray-800">Quantity</label>--}}
{{--                    <input data-product-id="{{$product->id}}" name="cart-item-quantity" type="number"--}}
{{--                           class="input-item-quantity w-[60px]  inline rounded-l-md px-0 pl-4" disabled--}}
{{--                           value="{{$quantityInCart}}">--}}
{{--                    <div class="flex flex-col">--}}
{{--                            <span data-product-id="{{$product->id}}"--}}
{{--                                  data-product-quantity="1"--}}
{{--                                  class="increment-to-cart h-[21px] text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-se text-sm px-2.5 py-1 text-center icon-plus"--}}
{{--                                  type="submit"></span>--}}
{{--                        <span--}}
{{--                            data-product-id="{{$product->id}}"--}}
{{--                            data-product-quantity="1"--}}
{{--                            class="decrement-from-cart h-[21px] text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-700 font-medium rounded-ee text-sm px-2.5 py-1 text-center icon-minus"--}}
{{--                            type="submit"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="my-5">
                <a href="#" data-product-id="{{$product->id}}" data-product-quantity="1"
                   class="{{($onCart) ? 'hidden ' : ''  }}  add-to-cart text-white bg-purple-600 hover:bg-purple-700 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">Add
                    to cart</a>
                <a href="#" data-product-id="{{$product->id}}" data-product-quantity="{{$quantityInCart}}"
                   class="{{($onCart) ? '' : 'hidden ' }} remove-from-cart text-green-600 bg-white border border-green-600 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-green-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Added to cart</a>
                <a href="{{back()}}" title="Back"
                   class="px-5 py-2.5 rounded-md text-white bg-gray-500 hover:bg-gray-400 ">Back</a>
            </div>
        </div>
    </div>

<x-slot name="script">
    <script src="{{asset('js/pages/product.js')}}"></script>
</x-slot>
</x-app-layout>
