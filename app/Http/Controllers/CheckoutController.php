<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;
use App\Models\Checkout;
use App\Models\User;
use App\Models\UserPaymentStatus;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

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
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }
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
//            'payment_method_types' => ['card'],
            'line_items' => [
                $pdts
            ],
            'customer_email' => \Auth::user()->email, // email do cliente
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => route('cart.index'),
            ]);
       return redirect($session->url, 303);
    }

    public function paymentStatusWebhook(\Request $request)
    {

        // The library needs to be configured with your account's secret key.
// Ensure the key is kept out of any version control system you might be using.
        $stripe = new \Stripe\StripeClient('sk_test_...');

// This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_47c4949008dccc57f564921a9d20b9312596e72851a9ec790c8763085567307e';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }


// Handle the event
        switch ($event->type) {
            case 'charge.succeeded':
                $paymentIntent = $event->data->object;
                $user = User::whereEmail($paymentIntent->billing_details->email)->first();

                if (empty($user)) {
                    $errorString = Date::now( )->toDateString() .
                        ' - Payment Id: ' . $paymentIntent->id . ' ErrorType: User not found';
                    if (!\Storage::disk('local')->exists('payment_error_log.txt')) {
                        \Storage::disk('local')->put('payment_error_log.txt', $errorString);
                    }
                    \Storage::disk('local')->append('payment_error_log.txt', $errorString);

                    Log::channel('slack')->error('Payment Error', ['error' => 'User not found',
                        'paymentIntent Id' => $paymentIntent->id,
                        'Date' => Date::now( )->toDateString()]);
                    break;
                }

                $paymentStatus = new UserPaymentStatus([
                    'cart_id' => $user->carts()->where('status', 'open')->first()->id,
                    'payment_type' => $paymentIntent->payment_method_details->type . "_" .
                        $paymentIntent->payment_method_details->card->funding,
                    'amount' => $paymentIntent->amount,
                    'currency' => $paymentIntent->currency,
                    'payment_id' => $paymentIntent->id,
                    'payment_status' => $paymentIntent->status,
                    'payment_date' => Date::now()->toDateString(),
                    'payment_details' => json_encode($paymentIntent),
                ]);

                if (!$user->paymentStatus()->save($paymentStatus)) {
                    $errorString = Date::now( )->toDateString() .
                        ' - Payment Id: ' . $paymentIntent->id . ' ErrorType: PaymentStatus not saved';

                    if (!\Storage::disk('local')->exists('payment_error_log.txt')) {
                        \Storage::disk('local')->put('payment_error_log.txt', $errorString);
                    }
                    \Storage::disk('local')->append('payment_error_log.txt', $errorString);

                    Log::channel('slack')->critical('Payment Error', ['error' => 'PaymentStatus not saved',
                        'paymentIntent Id' => $paymentIntent->id]);
                    break;
                }

                \Mail::to($user->email)->send(new \App\Mail\PaymentSucceeded($user, $paymentIntent));

                $user->carts()->where('status', 'open')->update(['status' => 'paid']);

                break;
            case 'charge.failed':
                $paymentIntent = $event->data->object;
                $user = User::whereEmail($paymentIntent->billing_details->email)->first();

                if (empty($user)) {
                    $errorString = Date::now( )->toDateString() .
                        ' - Payment Id: ' . $paymentIntent->id . ' ErrorType: User not found';
                    if (!\Storage::disk('local')->exists('payment_error_log.txt')) {
                        \Storage::disk('local')->put('payment_error_log.txt', $errorString);
                    }
                    \Storage::disk('local')->append('payment_error_log.txt', $errorString);

                    Log::channel('slack')->error('Payment Error', ['error' => 'User not found',
                        'paymentIntent Id' => $paymentIntent->id,
                        'Date' => Date::now( )->toDateString()]);
                    break;
                }

                $paymentStatus = new UserPaymentStatus([
                    'cart_id' => $user->carts()->where('status', 'open')->first()->id,
                    'payment_type' => $paymentIntent->payment_method_details->type . "_" .
                        $paymentIntent->payment_method_details->card->funding,
                    'amount' => $paymentIntent->amount,
                    'currency' => $paymentIntent->currency,
                    'payment_id' => $paymentIntent->id,
                    'payment_status' => $paymentIntent->status,
                    'payment_date' => Date::now()->toDateString(),
                    'payment_details' => json_encode($paymentIntent),
                ]);

                if (!$user->paymentStatus()->save($paymentStatus)) {
                    $errorString = Date::now('')->toDateString() .
                        ' - Payment Id: ' . $paymentIntent->id . ' ErrorType: PaymentStatus not saved';

                    if (!\Storage::disk('local')->exists('payment_error_log.txt')) {
                        \Storage::disk('local')->put('payment_error_log.txt', $errorString);
                    }
                    \Storage::disk('local')->append('payment_error_log.txt', $errorString);

                    Log::channel('slack')->critical('Payment Error', ['error' => 'PaymentStatus not saved',
                        'paymentIntent Id' => $paymentIntent->id]);
                    break;
                }

                \Mail::to($user->email)->send(new \App\Mail\PaymentFailed($user, $paymentIntent));

                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
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
