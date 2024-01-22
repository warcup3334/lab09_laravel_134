<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showproduct(){
        $products = Product::all();
        return $products;
    }
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['name'=>'index', 'payload'=>Product::all()];
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        $result = ['name'=>'store', 'payload' => $request->all()];
        return $result;
    }

    /**
     * Display the specified resource.
     * 
     *  @param \App\Models\Product $product
     *  @return \Illuminate\Http\Response
     */
    public function show(Product $id)
    {
        $result = ['name'=>'show', 'payload' => $id];
        return $result;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, Product $id)
    {
        $result = ['name'=>'update', 'payload'=> $request->all()];
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $id)
    {
        $result = ['name'=>'destroy', 'payload'=> $id];
        return $result;
    }
}
