@extends('backend.v_layouts.app')
@section('content')
<form action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Foto -->
    <label for="foto">Foto</label>
    <img class="foto-preview" src="#" alt="Preview Foto" style="display: none; max-width: 100px;">
    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto(this)">
    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <p></p>

    <!-- Hak Akses -->
    <label for="role">Hak Akses</label>
    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
        <option value="" {{ old('role') == '' ? 'selected' : '' }}>-</option>
        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Super Admin</option>
        <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option>
    </select>
    @error('role')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <p></p>

    <!-- Nama -->
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
    @error('nama')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <p></p>

    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
    @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <p></p>

    <!-- HP -->
    <label for="hp">HP</label>
    <input type="text" name="hp" id="hp" onkeypress="return isNumberKey(event)" class="form-control @error('hp') is-invalid @enderror" value="{{ old('hp') }}">
    @error('hp')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <p></p>

    <!-- Password -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
    @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <p></p>

    <!-- Konfirmasi Password -->
    <label for="password_confirmation">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
    <p></p>

    <br>
    <!-- Tombol -->
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">Batal</a>
</form>
<!-- contentAkhir -->
@endsection