<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Shop\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all carts
        $carts = Cart::all();
        return response()->json($carts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_id' => 'integer|min:1',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:new,processing,cancelled,success',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Retrieve customer_id using uid
        $customer = Customer::where('uid', $request->uid)->first();
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // Create a new cart
        $cart = new Cart;
        $cart->customer_id = $customer->id;
        $cart->uid = $request->uid;
        $cart->product_id = $request->product_id; // Corrected from productId to product_id
        $cart->quantity = $request->quantity;
        $cart->price = $request->price;
        $cart->status = $request->status;

        // Save the cart to the database
        $cart->save();

        return response()->json($cart, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the cart by ID
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        return response()->json($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the cart by ID
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:shop_customers,id',
            'product_id' => 'exists:shop_products,id',
            'uid' => 'unique:carts,uid,' . $cart->id,
            'quantity' => 'integer|min:1',
            'price' => 'numeric|min:0',
            'status' => 'in:new,processing,cancelled,success',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the cart with validated data
        $cart->update($request->all());

        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the cart by ID
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Delete the cart
        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully']);
    }
}
