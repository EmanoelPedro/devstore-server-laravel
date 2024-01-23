<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.checkout');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stripe = new \Stripe\StripeClient(getenv('PAYMENT_API_TEST_KEY'));

        $cart = \Auth::user()->carts()->where('status', 'open')->first();
        $products = $cart->products()->get();

        if ($products->isEmpty()) {
            return redirect()->route('cart.index');
        }

        foreach ($products as $product) {
             $pdts[] = [
                 'price_data' => [
                     'currency' => 'brl',
                     'product_data' => [
                         'name' => "{$product->name}",
                     ],
                     'unit_amount' => intval($product->price * 100),
                 ],
                 'quantity' => "{$product->pivot->quantity}",
             ];
        }

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $pdts
            ],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => route('cart.index'),
        ]);
       return redirect($session->url, 303);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheckoutRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckoutRequest $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
