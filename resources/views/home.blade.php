<x-app-layout>
    <x-carousel>
        @for($i=0;$i < 5; $i++)
            <x-carousel-image
                url="https://media.gazetadopovo.com.br/2019/07/11130451/939736ae3457783d8d736d90b47ad623-full-960x540.jpeg"
                src="{{asset('/logo-black.png')}}" alt="foo"></x-carousel-image>
        @endfor
    </x-carousel>
    @php
        foreach ($categories as $category):
           $products = $category->products()->where('status', '=', 'published')->get();
    @endphp
    <section class="flex flex-wrap py-10 px-11 lg:container lg:m-auto">
        <header class="w-full mb-5">
            <a href="{{route('categories.show', $category->slug)}}"
               class="text-5xl border-b-2 inline border-gray-300  capitalize font-semibold text-gray-900 dark:text-white">{{$category->name}}</a>
        </header>
        <div class="flex flex-row flex-wrap">
            @php
                foreach ($products as $product):
            @endphp
            <x-product-card url="{{route('products.show', [$product->slug])}}" :product="$product" rating="1">
                <x-slot name="image">
                    <x-image src="{{asset('storage/'. $product->photos()->first()->path)}}" alt="foo" width="bebebe"
                             class="p-8 rounded-t-lg"></x-image>
                </x-slot>
            </x-product-card>
            @php
                endforeach
            @endphp
        </div>
        {{--            <a href="{{route('categories.show', $category->slug)}}" class="text-white my-4 mx-auto bg-purple-600 hover:bg-purple-700 font-light rounded-md text-md px-6 py-2.5 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-purple-600 dark:bg-purple-600 dark:hover:bg-purple-600 dark:focus:ring-purple-600">Ver mais</a>--}}
    </section>
    @php
        endforeach;
    @endphp
    <x-slot name="script">
        <script src="{{asset('js/functions/functions.js')}}"></script>
        <script src="{{asset('js/pages/home.js')}}"></script>
    </x-slot>
</x-app-layout>

