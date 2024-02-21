@php
    if (\Illuminate\Support\Facades\Auth::check()) {
            $cart = \Illuminate\Support\Facades\Auth::user()->carts()->where('status', 'open')->first();
      $cartItems = $cart->products()->get();
    }
@endphp
<x-app-layout>

    <section class="flex flex-row flex-wrap p-5 bg-gray-200 rounded-lg mx-auto lg:container">
        <h1 class="basis-full text-3xl font-bold text-center text-gray-900">My Cart</h1>
            <div class="items-box basis-full flex flex-row flex-wrap justify-start pb-12">
                @foreach($cartItems as $cartItem)
                    <div data-product-id="{{$cartItem->id}}" class="basis-[25%] flex flex-row flex-wrap p-4 py-5 sm:basis-[33.33%] mb:basis-full mb:my-10 mb:justify-center mb:py-12">
                        <img class="w-[100px] block rounded-lg shadow h-full mb:w-full sm:w-[300px] sm:h-[300px] sm:mx-auto" src="{{$cartItem->photos()->first()->url}}"
                             alt="{{$cartItem->name}}"/>

                        <h1 class=" text-lg font-bold text-gray-900 sm:basis-full sm:text-center sm:text-3xl sm:my-3 mb:text-center mb:my-3 mb:text-2xl">{{$cartItem->name}}</h1>

                        <div class="m-w-full flex flex-row items-center sm:basis-full mb:basis-full mb:mx-auto justify-center">
                            <label for="quantity" class="text-lg mr-3 text-gray-800">Quantity</label>
                            <input data-product-id="{{$cartItem->id}}" name="cart-item-quantity" type="number"
                                   class="w-[60px]  inline rounded-l-md px-0 pl-4" disabled
                                   value="{{$cartItem->pivot->quantity}}">
                            <div class="flex flex-col">
                            <span data-product-id="{{$cartItem->id}}"
                                  data-product-quantity="1"
                                  class="increment-to-cart h-[21px] text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-se text-sm px-2.5 py-1 text-center icon-plus"
                                  type="submit"></span>
                                <span
                                    data-product-id="{{$cartItem->id}}"
                                    data-product-quantity="1"
                                    class="decrement-from-cart h-[21px] text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-ee text-sm px-2.5 py-1 text-center icon-minus"
                                    type="submit"></span>
                            </div>
                            <span data-product-id="{{$cartItem->id}}"
                                  data-product-quantity="{{$cartItem->pivot->quantity}}"
                                  class="remove-from-cart h-[42px]  ml-5 text-white text-xl bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-2.5 py-2 text-center icon-times"
                                  type="submit"></span>
                        </div>

                        <div class="flex flex-row mx-5 items-center sm:basis-full sm:text-center sm:mt-3 mb:mt-3">
                            <p class="text-gray-900 mx-auto inline">Unity: U$ {{$cartItem->price}}</p>
                        </div>
                        <div class="flex flex-row mx-5 items-center sm:basis-full text-center">
                            <p class="text-gray-900 mx-auto inline">Total: U$
                                <span data-product-id="{{$cartItem->id}}" class="item-total-price">
                                    {{$cartItem->pivot->quantity * $cartItem->price}}
                                </span></p>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="{{$cartItems->isEmpty() ? 'hidden ' : ''}} cart-total-value-box flex flex-row basis-full items-center bg-gray-300 p-5 mx-10 rounded-md">
                <h1 class="text-lg font-bold text-center text-gray-900">Total U$</h1>
                <p class="cart-total-price text-gray-900 ml-2">{{$cart->getTotalValue()}}</p>
                <a href="{{route('checkout.create') }}"
                   class="text-white ml-3 bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Go
                    to Checkout</a>
            </div>

        <div class="{{$cartItems->isEmpty() ? '' : 'hidden '}} cart-no-items-box basis-full flex flex-col justify-center items-center py-3 mt-5 bg-gray-300 rounded-md">
            <h1 class="text-lg font-bold text-center text-gray-800">No items in the cart</h1>
            <a href="{{route('site.home')}}"
               class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-600 font-medium rounded-lg text-sm px-5 py-2.5 mt-2 text-center ">Go
                to Products</a>
        </div>

    </section>

    <x-slot name="script">
        <script src="{{asset('js/pages/cart.js')}}"></script>
    </x-slot>
</x-app-layout>

