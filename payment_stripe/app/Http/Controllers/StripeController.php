<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Payment;

    class StripeController extends Controller
    {
        public function stripe(Request $request)
        {
            // Validate request
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:1',
                'quantity' => 'nullable|integer|min:1',
            ]);
            
            // Initialize Stripe
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            // Create checkout session
            $response = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $validated['product_name'],
                        ],
                        'unit_amount' => (int) ($validated['price'] * 100), // convert to cents
                    ],
                    'quantity' => $validated['quantity'] ?? 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
            ]);

            if (!empty($response->id)) {
                // Save order details in session
                session([
                    'product_name' => $validated['product_name'],
                    'quantity' => $validated['quantity'] ?? 1,
                    'price' => $validated['price'],
                ]);

                return redirect($response->url);
            }

            return redirect()->route('cancel');
            }

            public function success(Request $request)
            {
                
            if ($request->has('session_id')) {
                $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
                $response = $stripe->checkout->sessions->retrieve(
                    $request->session_id,
                    ['expand' => ['line_items', 'customer_details']]
                );

                $lineItem = $response->line_items->data[0] ?? null;
                
                $payment = new Payment();
                $payment->payment_id = $response->id;
                $payment->product_name = $lineItem?->description ?? session('product_name', 'Unknown Product');
                $payment->quantity = $lineItem?->quantity ?? session('quantity', 1);
                $payment->amount = ($lineItem?->amount_total ?? session('price', 0));
                $payment->currency = $response->currency ?? 'usd';
                $payment->payer_name = $response->customer_details->name ?? 'N/A';
                $payment->payer_email = $response->customer_details->email ?? 'N/A';
                $payment->payment_status = $response->status ?? 'unpaid';
                $payment->payment_method = "Stripe";
                $payment->save();

                // Clear session (optional, for safety)
                session()->forget(['product_name', 'quantity', 'price']);

                return "Payment is successful ";
            }

            return redirect()->route('cancel');
        }

        public function cancel()
        {
            return "Payment was canceled ";
        }
    }
