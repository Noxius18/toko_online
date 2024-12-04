<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
</head>
<body>
    <h2>{{ $judul }} </h2>
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('error') }}</strong>
    </div>
    @endif

    <form action="{{ route('backend.login') }}" method="POST">
        @csrf
        <label for="user">User</label> <br />
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
        @error('email')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
        @enderror
        <br /> <br />

        <label for="password">Password</label> <br />
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
        @error('password')
        <span class="invalid-feedback alert-danger" role="alert">
            {{ $message }}
        </span>
        @enderror
        <br /> <br />

        <button type="submit">Login</button>
    </form>
</body>
</html>