<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Test</title>
</head>
<body>
    @extends('backend.v_layouts.app')
    @section('content')
    
        <h3> {{ $judul }} </h3>
        <p>
            Selamat datang, <b>{{ Auth::user()->nama }}</b> pada aplikasi Toko Online dengan hak akses yang anda miliki sebagai 
            <b>
                @if (Auth::user()->role == 0)
                Super Admin
                @elseif (Auth::user()->role == 1)
                Admin
                @endif
            </b> 
            <br />
            Ini adalah halaman utama dari aplikasi ini
        </p>

    @endsection
</body>
</html>