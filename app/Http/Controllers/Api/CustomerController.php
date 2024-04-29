<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all customers
        $customers = Customer::all();

        // Return the customers as JSON
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create a new customer
        $customer = new Customer;

        // Return the customer as JSON
        return response()->json($customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'uid' => 'required',
            'email' => 'required|email',
        ]);

        // Create a new customer
        $customer = new Customer;

        // Set the customer's attributes
        $customer->uid = $request->uid;
        $customer->email = $request->email;
        // Save the customer to the database
        $customer->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the customer
        $customer = Customer::find($id);

        // Return the customer as JSON
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Edit the customer
        $customer = Customer::find($id);

        // Return the customer as JSON
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'uid' => 'required',
            'email' => 'required|email',
        ]);

        // Get the customer
        $customer = Customer::find($id);

        // Set the customer's attributes
        $customer->uid = $request->uid;
        $customer->email = $request->email;

        // Save the customer to the database
        $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the customer
        Customer::destroy($id);

        // Return a success message
        return response()->json(['message' => 'Customer deleted']);
    }
}
