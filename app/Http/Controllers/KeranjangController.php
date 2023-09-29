<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function index()
    {
        // Mengambil daftar keranjang
        $keranjang = Keranjang::all();
        return response()->json($keranjang);
    }

    public function show($id)
    {
        // Mengambil keranjang berdasarkan ID
        $keranjang = Keranjang::find($id);
        return response()->json($keranjang);
    }

    public function store(Request $request)
    {
        // Membuat keranjang baru
        $keranjang = new Keranjang;
        $keranjang->makanan_id = $request->input('makanan_id');
        $keranjang->jumlah = $request->input('jumlah');
        $keranjang->save();
        return response()->json($keranjang, 201);
    }

    public function update(Request $request, $id)
    {
        // Mengupdate keranjang berdasarkan ID
        $keranjang = Keranjang::find($id);
        $keranjang->makanan_id = $request->input('makanan_id');
        $keranjang->jumlah = $request->input('jumlah');
        $keranjang->save();
        return response()->json($keranjang);
    }

    public function destroy($id)
    {
        // Menghapus keranjang berdasarkan ID
        $keranjang = Keranjang::find($id);
        $keranjang->delete();
        return response()->json(['message' => 'Keranjang berhasil dihapus']);
    }
}
