<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){
        return view('stripe');
    }

    public function charge(Request $request){
        
        $script = new \Stripe\StripeClient(env('STRIPE_SECRRET'));

        $charge = $script->charges->create([
            'amount' => $request->price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment from Larvel Stripe Example From Webappfix',
        ]);
        return back()->withSuccess('Payment successful');
    }   
}
