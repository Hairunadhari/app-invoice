<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keranjang.index',[
            'keranjang' => Keranjang::with('produk','user')->latest()->paginate(5),
        ]);
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
          // dd($request);
          $validated = $request->validate([
            'jumlah_pesan' => 'required|numeric',
            'produk_id' => 'required|numeric',
        ]);
        
        $request->user()->keranjang()->create($validated);
        return redirect(route('keranjang.index'))->with(['success' => 'Produk Disimpan ke Keranjang!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        $keranjang->delete($keranjang);

        return redirect(route('keranjang.index'))->with(['success' => 'Produk Dihapus!']);
    }
}
