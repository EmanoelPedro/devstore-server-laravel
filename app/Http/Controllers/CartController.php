<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
    
        $user = User::find(Auth::user());
    
        if(empty($user)) {
           return response()->json([
                'status' => 'error',
                'message' => 'User not exists'
            ], 404);
        }
        
        if($user->haveOpenCart() == true){
            return response()->json([
                "status" => "success",
                "message" => "User already has a cart"
            ]);
        }

        $user->carts()->create([
            'user_id' => $user->id,
            'status' => 'open'
        ]);

       return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        $user = Auth::user();

        $cart = $user->getOpenCart();
        if(empty($cart)) {
         $cart = $user->carts()->create([
                'user_id' => $user->id,
                'status' => 'open'
            ]);
        }
        // dd($cart->products()->first());

        return view('pages.cart', ['cart' => $cart]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
