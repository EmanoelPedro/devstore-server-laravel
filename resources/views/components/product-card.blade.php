@php
    $onCart = false;
    $quantityInCart = 0;
    if (auth()->check()) {
        $user = auth()->user();
        $cart = $user->carts()->where('status','open')->first();
        $products = $cart->products()->get();
        if ($products->contains($product->id)) {
        $quantityInCart = $products->find($product->id)->pivot->quantity;
        $onCart = true;
        }
    }
@endphp

<div
    class="w-full m-3 overflow-auto lg:max-w-[calc(25%-1.5rem)] hover:shadow-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ $url }}">
        {{$image}}
    </a>
    <div class="px-5 pb-5">
        <a href="{{ $url }}">
            <h5 class="text-xl mt-1 font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
        </a>

        @php
            if (!empty($rating)):
        @endphp
        <div class="flex items-center mt-2.5 mb-5">
            @php
                for ($i =0; $i < $rating; $i++):
            @endphp
            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
            </div>
            @php
                endfor;
            @endphp
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">{{$rating}}.0</span>
        </div>
        @php
            endif;
        @endphp
        <div class="flex items-center justify-between">
            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->price }}</span>

            <a href="#" data-product-id="{{$product->id}}" data-product-quantity="1"
               class="{{($onCart) ? 'hidden ' : ''  }}  add-to-cart text-white bg-purple-600 hover:bg-purple-700 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">Add
                to cart</a>
            <a href="#" data-product-id="{{$product->id}}" data-product-quantity="{{$quantityInCart}}"
               class="{{($onCart) ? '' : 'hidden ' }} remove-from-cart text-green-600 bg-white border border-green-600 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-green-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Added
                to cart</a>
        </div>
    </div>
</div>
