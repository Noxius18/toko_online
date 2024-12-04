<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('updated_at', 'desc')->get();
        return view('backend.v_produk.index', [
            'judul' => 'List Produk',
            'index' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_produk.create', [
            'judul' => 'Tambah Produk',
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|max:255|unique:produk',
            'detail' => 'required',
            'harga' => 'required|numeric',
            'berat' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif,svg|file|max:1024'
        ], $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png atau gif',
            'foto.max' => 'Ukuran gambar maksimal adalah 1024 KB'
        ]);
        
        $validateData['user_id'] = Auth::id();
        $validateData['status'] = 0;

        if($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-produk';

            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validateData['foto'] = $fileName;

            // Thumbnail Ukuran Large
            $thumbnailLg = 'thumb_lg' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);

            // Thumbnail Ukuran Medium
            $thumbailMd = 'thumb_md' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbailMd, 500, 519);

            // Thumbnail Ukuran Small
            $thumbnailSm = 'thumb_sm' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailSm, 100, 110);
        }

        Produk::create($validateData);
        return redirect()->route('backend.produk.index')->with('success', 'Produk berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
