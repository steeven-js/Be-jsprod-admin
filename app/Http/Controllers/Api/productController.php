<?php

namespace App\Http\Controllers\api;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productController extends Controller
{
    // Get all products with their relationships and paginate them
    public function index()
    {
        $products = Product::get();

        return response()->json($products);
    }


    // Get a single post
    public function show($id)
    {
        $post = Product::find($id);

        return response()->json($post);
    }
}
