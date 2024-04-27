<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\StockMovings;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Products::all();
        return view('product.index', compact('products'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Products::create($request->all());

        $product->addMedia($request->file('picture'))->toMediaCollection('product-img');

        $stockMovings = [
            'product_id' => $product->id,
            'description' => 'Stock Awal',
            'moving_stock' => $product->stock,
            'moving_price' => $product->price,
        ];

        StockMovings::create($stockMovings);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        $stockLog = StockMovings::query()->where('product_id', $product->id)->get();

        return view('product.detail', compact('product', 'stockLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
