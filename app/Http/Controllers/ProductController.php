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
        $products = Product::latest()->paginate(5);
        return view('produk.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        
        Product::create($validated);
        return redirect(route('product.index'))->with(['success' => 'Produk Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('produk.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',  
            'stok' => 'required|numeric',
        ]);
        $product->update($validated);
        return redirect(route('product.index'))->with(['success' => 'Data Berhasil diEdit!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete($product);

        return redirect(route('product.index'))->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
