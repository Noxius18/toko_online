<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            
            
        $validatedData = $request->validate(
            [
                'nama' => 'required|max:255',
                'email' => 'required|max:255|email|unique:user',
                'role' => 'required',
                'hp' => 'required|min:10|max:13',
                'password' => 'required|min:4|confirmed',
                'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
            ],
            $messages = [
                'foto.image' => 'Format gambar harus menggunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
                'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.',
            ]
        );
        
        // Set nilai default untuk status
        $validatedData['status'] = 0;
        
        // Menggunakan ImageHelper jika ada file foto yang diunggah
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
        
            // Simpan gambar dengan ukuran yang ditentukan menggunakan ImageHelper
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
        
            // Simpan nama file ke database
            $validatedData['foto'] = $originalFileName;
        }
        
        // Validasi password menggunakan pola kombinasi
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'; // Aturan kombinasi
        
        if (preg_match($pattern, $password)) {
            // Hash password jika valid
            $validatedData['password'] = Hash::make($validatedData['password']);
        
            // Simpan data user ke database
            User::create($validatedData);
        
            // Redirect dengan pesan sukses
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan');
        } else {
            // Kembalikan ke halaman sebelumnya dengan error pada password
            return redirect()->back()->withErrors([
                'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.',
            ]);
        }
        
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
        $user = User::findOrFail($id);
        if($user->foto) {
            $pathFotoLama = public_path('storage/img-user') . $user->foto;
            if(file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }
        $user->delete();
        return redirect()->route('backend.user.index')->with('success', 'Data Berhasil Dihapus');
    }
}
