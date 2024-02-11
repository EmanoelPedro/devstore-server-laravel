@php
    if (\Illuminate\Support\Facades\Auth::check()) {
            $cart = \Illuminate\Support\Facades\Auth::user()->carts()->where('status', 'open')->first();
      $cartItems = $cart->products()->get();
    }
  //  dd(session()->get('cart'), $cartItems[0]->pivot->quantity);
@endphp
<x-app-layout>

    <section class="flex flex-row flex-wrap lg:container bg-gray-400 mx-auto">
        <h1 class="basis-full text-3xl font-bold text-gray-900">Cart</h1>
        <div class="items-box basis-[70%] flex flex-col">
            @foreach($cartItems as $cartItem)
                <div data-product-id="{{$cartItem->id}}" class="flex flex-row basis-full mx-10 my-5">
                    <img class="w-[100px] rounded-lg shadow h-full" src="{{$cartItem->photos()->first()->url}}"
                         alt="{{$cartItem->name}}"/>
                    <h1 class="w-[300px] text-lg font-bold text-gray-900">{{$cartItem->name}}</h1>

                    <div class="w-[250px] flex flex-row items-center">
                        <label for="quantity" class="text-lg mr-3 text-gray-800">Quantity</label>
                        <input data-product-id="{{$cartItem->id}}" name="cart-item-quantity" type="number" class="w-[42px]  inline rounded-l-md px-0 pl-4" disabled
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
                    <div class="flex flex-row mx-5 items-center">
                        <p class="text-gray-900">Unity: U$ {{$cartItem->price}}</p>
                    </div>
                    <div class="flex flex-row mx-5 items-center">
                        <p class="text-gray-900">Total: U$ {{$cartItem->pivot->quantity * $cartItem->price}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-row basis-[30%]">
            <h1 class="text-lg font-bold text-gray-900">Total</h1>
            <p class="text-gray-900">U$ {{$cart->total}}</p>
        </div>
    </section>

    <div class="w-3/12 mx-10">
        <h1 class="text-lg font-bold text-gray-900">Add To Cart</h1>
        <form class="my-3" action="{{route('products.addToCart')}}" method="post">
            @csrf
            <div class="flex flex-col">
                <label for="product_id">Product Id</label>
                <input class="my-2" type="number" id="product_id" name="product_id" placeholder="product id">
                <input class="my-2" type="number" id="quantity" name="quantity" placeholder="quantity">
            </div>
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                type="submit">Add to Cart
            </button>
        </form>

    </div>

    <div class="w-3/12 mx-10 mt-10">
        <h1 class="text-lg font-bold text-gray-900">Remove To Cart</h1>
        <form class="my-3" action="{{route('products.removeFromCart')}}" method="post">
            @csrf
            <div class="flex flex-col">
                <label for="product_id">Product Id</label>
                <input class="my-2" type="number" id="product_id" name="product_id" placeholder="product id">
                <input class="my-2" type="number" id="quantity" name="quantity" placeholder="quantity">
            </div>
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center "
                type="submit">Add to Cart
            </button>
        </form>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mt-2 text-sm text-red-600 ">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-slot name="script">
        <script src="{{asset('js/pages/cart.js')}}"></script>
    </x-slot>
</x-app-layout>

