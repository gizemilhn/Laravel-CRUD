<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::FindOrFail($id);
        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::FindOrFail($id);
        return view('update', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product=Product::FindOrFail($id);
        $product->update($request->all());
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $product = Product::find($id);
    if ($product) {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }
    return response()->json(['message' => 'Product not found.'], 404);
}
public function trashed()
{
    $trashedProducts = Product::onlyTrashed()->get();
    return view('products.trashed', compact('trashedProducts'));
}
public function restore($id)
{
    $product = Product::withTrashed()->find($id);
    if ($product) {
        $product->restore();
        return response()->json(['message' => 'Product restored successfully.']);
    }
    return response()->json(['message' => 'Product not found.'], 404);
}



}
