<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\Foto;

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
            $thumbnailLg = 'thumb_lg_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);

            // Thumbnail Ukuran Medium
            $thumbailMd = 'thumb_md_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbailMd, 500, 519);

            // Thumbnail Ukuran Small
            $thumbnailSm = 'thumb_sm_' . $originalFileName;
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
        $produk = Produk::with('fotoProduk')->findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.show', [
            'judul' => 'Detail Produk',
            'show' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
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
        $produk = Produk::findOrFail($id);
        $directory = public_path('storage/img-produk');

        if($produk->foto) {
            $pathFotoLama = $directory . $produk->foto;
            if(file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }

            $thumbnailLg = $directory . 'thumb_lg_' . $produk->foto;
            if(file_exists($thumbnailLg)) {
                unlink($thumbnailLg);
            }

            $thumbnailMd = $directory . 'thumb_md_' . $produk->foto;
            if(file_exists($thumbnailMd)) {
                unlink($thumbnailMd);
            }

            $thumbnailSm = $directory . 'thumb_sm_' . $produk->foto;
            if(file_exists($thumbnailSm)) {
                unlink($thumbnailSm);
            }

            
        }
        $fotoProduks = Foto::where('produk_id', $id)->get();
        foreach($fotoProduks as $fotoProduk) {
            $pathFoto = $directory . $fotoProduk->foto;
            if(file_exists($pathFoto)){
                unlink($pathFoto);
            }
            $fotoProduk->delete();
        }

        $produk->delete();

        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil dihapus!');
    }

    public function storeFoto(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'foto_produk.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);

        if ($request->hasFile('foto_produk')) {
            foreach ($request->file('foto_produk') as $file) {
                // Buat nama file yang unik
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/img-produk/';

                // Simpan dan resize gambar menggunakan ImageHelper
                ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);

                // Simpan data ke database
                Foto::create([
                    'produk_id' => $request->produk_id,
                    'foto' => $filename,
                ]);
            }
        }

        return redirect()->route('backend.produk.show', $request->produk_id)
            ->with('success', 'Foto berhasil ditambahkan.');
    }

// Method untuk menghapus foto
    public function destroyFoto($id)
    {
        $foto = Foto::findOrFail($id);
        $produkId = $foto->produk_id;

        // Hapus file gambar dari storage
        $imagePath = public_path('storage/img-produk/') . $foto->foto;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Hapus record dari database
        $foto->delete();

        return redirect()->route('backend.produk.show', $produkId)
            ->with('success', 'Foto berhasil dihapus.');
    }
}
