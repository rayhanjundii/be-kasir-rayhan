<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;

class MakananController extends Controller
{
    public function index()
    {
        $makanan = Makanan::orderBy('created_at', 'desc')->get();
        return response()->json($makanan);
    }


    public function show($id)
    {
        // Mengambil makanan berdasarkan ID
        $makanan = Makanan::find($id);
        return response()->json($makanan);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
        ]);
    
        // Upload gambar
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('uploads'), $namaGambar);
    
        // Simpan data makanan
        $makanan = new Makanan;
        $makanan->nama = $request->input('nama');
        $makanan->gambar = '/uploads/' . $namaGambar; // Path gambar dari direktori uploads
        $makanan->harga = $request->input('harga');
        $makanan->save();
    
        return response()->json($makanan, 201);
    }
    


    public function update(Request $request, $id)
    {
        // Mengupdate makanan berdasarkan ID
        $makanan = Makanan::find($id);
        $makanan->nama = $request->input('nama');
        $makanan->gambar = $request->input('gambar');
        $makanan->harga = $request->input('harga');
        $makanan->save();
        return response()->json($makanan);
    }

    public function destroy($id)
    {
        // Menghapus makanan berdasarkan ID
        $makanan = Makanan::find($id);
        $makanan->delete();
        return response()->json(['message' => 'Makanan berhasil dihapus']);
    }
}
