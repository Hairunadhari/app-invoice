<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    
    public function index()
    {
        $data = Pelanggan::latest()->paginate(5);
        return view('pelanggan.index',compact('data'));
    } 

    public function create()
    {
        return view('pelanggan.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telp' => 'required|numeric',
        ]);
        
        Pelanggan::create($validated);
        return redirect(route('pelanggan.index'))->with(['success' => 'Data Berhasil Ditambah!']);
    }

    public function show(Pelanggan $pelanggan)
    {
        //
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', ['pelanggan' => $pelanggan,]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telp' => 'required|numeric',   
        ]);
        $pelanggan->update($validated);
 
        return redirect(route('pelanggan.index'))->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete($pelanggan);

        return redirect(route('pelanggan.index'))->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
