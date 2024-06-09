<?php

namespace App\Http\Controllers\api;

use App\Models\Cart;
use App\Models\Shop\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Customer;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'uid' => 'required',
        ]);

        $customer = Customer::where('uid', $request->uid)->first();

        \Stripe\Stripe::setApiKey('sk_test_51LeOHYBy39DOXZlGW09bx55BbH1bl4HiaBQbUKUns3aW94VFvRowCJUx8b7gohpOWSe7g4ms1y57H3AAub444zsX00ehwupWiB');

        $products = Cart::where('uid', $request->uid)->get();
        $lineItems = [];
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $request->services->name,
                        'images' => ['https://firebasestorage.googleapis.com/v0/b/admin-jsprod.appspot.com/o/a.png?alt=media&token=b2be40aa-0137-4fcb-abbd-4053ebf6095b']
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ];
        }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost:8000/cancel/{CHECKOUT_SESSION_ID}',
        ]);

        $order = new Order();
        $order->shop_customer_id = $customer->id;
        $order->number = 'OR' . rand(100000, 999999);
        $order->currency = 'eur';
        $order->status = 'unpaid';
        $order->total_price = $totalPrice;
        $order->session_id = $session->id;
        $order->save();

        return response()->json(['url' => $session->url]);
    }

    public function success($sessionId)
    {
        \Stripe\Stripe::setApiKey('sk_test_51LeOHYBy39DOXZlGW09bx55BbH1bl4HiaBQbUKUns3aW94VFvRowCJUx8b7gohpOWSe7g4ms1y57H3AAub444zsX00ehwupWiB');

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        $order = Order::where('session_id', $session->id)->first();

        $order->status = 'paid';
        $order->save();

        return redirect('http://localhost:3001/e-commerce/order-completed');
    }

    public function cancel()
    {
        \Stripe\Stripe::setApiKey('sk_test_51LeOHYBy39DOXZlGW09bx55BbH1bl4HiaBQbUKUns3aW94VFvRowCJUx8b7gohpOWSe7g4ms1y57H3AAub444zsX00ehwupWiB');

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        $order = Order::where('session_id', $session->id)->first();

        $order->status = 'unpaid';
        $order->save();

        return redirect('http://localhost:3001/e-commerce/order-completed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
