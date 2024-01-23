<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $cart = $request->user()->carts();

        if ($cart->where('status', 'open')->first() == null) {
            $request->user()->carts()->create([
                'user_id' => $request->user()->id,
                'status' => 'open'
            ]);
        } else {
            $cart = $cart->where('status', 'open')->first();
            $products = $cart->products()->get();
            if (!$products->isEmpty()) {
                foreach ($products as $product) {
                    session()->put("cart.products.{$product->id}",['quantity' => $product->pivot->quantity]);
                }
            }
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
