<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
</head>
<body>
    @extends('backend.v_layouts.app')
    @section('content')

    <h3>{{ $judul }}</h3>
    <a href="{{ route('backend.user.create') }}">
        <button type="button">Tambah</button>
    </a>
    <table border="1" width="80%">
        <tr>
            <td>No</td>
            <td>Email</td>
            <td>Nama</td>
            <td>Role</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>
        @foreach ($index as $row)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $row->email }} </td>
            <td> {{ $row->nama }} </td>
            <td> {{ $row->role }} </td>
            <td> {{ $row->status }} </td>
            <td>
                <a href="{{ route('backend.user.edit', $row->id) }}">
                    <button type="button">Edit</button>
                </a>
                <form action="{{ route('backend.user.destroy', $row->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endsection
</body>
</html>