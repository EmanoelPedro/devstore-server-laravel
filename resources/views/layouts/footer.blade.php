<footer>
    <div class="container pt-20 pb-8 mx-auto border-b-2 border-gray-300 mb:px-4 mb:mx-auto">
        <h1 class="mb-5 text-2xl text-gray-900 font-semibold">THE BEST NERDS AND GEEKS PRODUCTS IN BRAZIL</h1>
        <p class="text-gray-700 text-normal">Discover the incredible selection of nerd and geek products here at Nerdstore, the largest nerd and geek store in Brazil!</p><br>

            <p class="text-normal text-gray-700">We offer a wide variety of geek, nerdy and creative items. Our team carefully selects books, mugs, t-shirts, hoodies, nerdy decor and more to suit the tastes of fans and collectors.</p><br>

            <p class="text-normal text-gray-700">If you are looking for the perfect gift, you will find many creative options to gift your loved ones. Our online store has a variety of gifts for boyfriends, wives, mothers, fathers and everyone who loves the geek universe and exclusive products. With themes ranging from Cthulhu, Game Of Thrones, The Lord of the Rings, J.R.R. Tolkien, video games and even DC and Marvel superheroes, we certainly have something special for everyone.</p><br>

            <p class="text-normal text-gray-700">We also have basic t-shirts, a JOKER t-shirt to save you from any situation. An essential item in your wardrobe. Take advantage of the fact that we have 8 sizes available.</p><br>

            <p class="text-normal text-gray-700">Furthermore, here at Nerdstore, we offer ease of purchase. You have the option of paying your purchases in up to 12 interest-free installments, ensuring greater convenience. And, for your greatest satisfaction, we are committed to delivering products quickly.</p><br>

            <p class="text-normal text-gray-700">Immerse yourself in the world of the best nerd and geek products in Brazil! Don't miss the opportunity to purchase exclusive items and show your love for nerd culture.</p><br>
    </div>

    <div class="flex flex-row flex-wrap justify-between container pb-8 pt-5 mx-auto mb:px-4">
        <div id="payment-methods" class="flex flex-row grow flex-wrap sm:justify-center sm:basis-full mb:justify-center mb:basis-full">
            <p class="basis-full mb-0 text-gray-700 font-semibold sm:text-center mb:text-center">Payment Methods:</p>
            <img class="w-[60px] my-2 mx-3" src="{{asset('payment_images/visa.svg')}}" alt="visa">
            <img class="w-[60px] my-2 mx-3" src="{{asset('payment_images/mastercard.svg')}}" alt="mastercard">
            <img class="w-[60px] my-2 mx-3" src="{{asset('payment_images/american-express.svg')}}" alt="american express">
            <img class="w-[60px] my-2 mx-3" src="{{asset('payment_images/paypal.svg')}}" alt="Paypal">
        </div>
        <div class="flex basis-3/12 flex-row flex-wrap sm:basis-full sm:justify-center mb:basis-full mb:justify-center  mb:pt-5">
            <p class="basis-full mb-0 text-gray-700 font-semibold sm:text-center mb:text-center">Qualidade e segurança</p>
            <img class="w-[60px] my-2 mx-3" src="{{asset('lets-encrypt.svg')}}" alt="Lets Encript">
            <img class="w-[180px] my-2 mx-3" src="{{asset('google-safe-browsing.svg')}}" alt="google Safe Browsing">
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-row flex-nowrap justify-center mb:flex-wrap">
            <div class="flex flex-col w-full lg:w-1/4 px-4 mb-8 lg:mb-0 mb:basis-1/2">
                <h2 class="text-xl font-bold mb-4 mb:text-center">Institutional</h2>
                <a href="#" class="text-purple-600  hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600 mb:text-center">Quem somos</a>
                <a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600 mb:text-center">Cupons</a>
                <a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600 mb:text-center">Termos de uso</a>
            </div>
            <div class="flex flex-col w-full lg:w-1/4 px-4 mb-8 lg:mb-0 mb:basis-1/2">
                <h2 class="text-2xl font-bold mb-4 mb:text-center">Categorias</h2>
                @php
                $categories = \App\Models\Category::all();
                foreach ($categories as $category):
                @endphp
                <a href="{{route('categories.show', $category->slug)}}" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600 mb:text-center">{{$category->name}}</a>
                @php
                endforeach;
                @endphp
            </div>
            <div class="flex flex-col w-full lg:w-1/4 px-4 mb-8 lg:mb-0 mb:basis-full mb:basis-1/2">
                <h2 class="text-2xl font-bold mb-4 mb:text-center">Pages</h2>
                <ul class="mb:text-center">
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Home</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">My Orders</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Shop</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Checkout</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Profile</a></li>
                </ul>
            </div>
            <div class="flex flex-col w-full lg:w-1/4 px-4 mb-8 lg:mb-0 mb:basis-1/2">
                <h2 class="text-2xl font-bold mb-4 mb:text-center">Social</h2>
                <ul class="mb:text-center">
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Instagram</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Github</a></li>
                    <li><a href="#" class="text-purple-600 hover:text-purple-700 focus:ring-2 focus:ring-offset-1 focus:ring-purple-600">Linkedin</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex flex-row flex-wrap">
        <div class="basis-full pt-10 pb-5 text-center text-white bg-gray-900">
            <p>Developed by - <a href="https://www.linkedin.com/in/emanoel-pedro" class="underline underline-offset-2 hover:text-purple-600">Emanoel Pedro</a></p>
            <div>
              <ul class="flex flex-row justify-center py-5">
                  <a href="" class="mx-3 text-2xl icon-linkedin-square"></a>
                  <a href="" class="mx-3 text-2xl icon-github-square"></a>
                  <a href="" class="mx-3 text-2xl icon-instagrem"></a>
              </ul>
            </div>
        </div>
    </div>
</footer>
