<h1 style="font-size: 24px; font-weight: bold;">Payment Successful!</h1>
<p>Hi {{ $user->first_name }},</p>
<p>This email confirms that your recent payment has been successfully received.</p>
<p>Here's a quick rundown:</p>
<ul>
    <li><b>Payment amount:</b> {{$payment->amount}}</li>
    <li><b>Payment date:</b> {{$payment->created}}</li>
</ul>

<p>Thanks</p>
<p>The {{env('APP_NAME')}} Team</p>
<p style="font-size: smaller;">P.S. You can always view your order details and manage your account settings by logging in to <a href="{{route('profile.orders')}}">My Orders</a>.</p>
