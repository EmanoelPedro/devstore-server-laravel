<x-app-layout>
     <div class="w-3/12 mx-10">
         <h1 class="text-lg font-bold text-gray-900">Add To Cart</h1>
         <form class="my-3" action="{{route('products.addToCart')}}" method="post">
             @csrf
             <div class="flex flex-col">
                 <label for="product_id">Product Id</label>
                 <input class="my-2" type="number" id="product_id" name="product_id" placeholder="product id">
                 <input class="my-2" type="number" id="quantity" name="quantity" placeholder="quantity">
             </div>
             <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="submit">Add to Cart</button>
         </form>

     </div>

    <div class="w-3/12 mx-10 mt-10">
         <h1 class="text-lg font-bold text-gray-900">Remove To Cart</h1>
         <form class="my-3" action="{{route('products.removeToCart')}}" method="post">
             @csrf
             <div class="flex flex-col">
                 <label for="product_id">Product Id</label>
                 <input class="my-2" type="number" id="product_id" name="product_id" placeholder="product id">
                 <input class="my-2" type="number" id="quantity" name="quantity" placeholder="quantity">
             </div>
             <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="submit">Add to Cart</button>
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
</x-app-layout>

