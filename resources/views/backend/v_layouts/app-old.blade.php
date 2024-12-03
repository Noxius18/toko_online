<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
</head>
<body>
    <a href="{{ route('backend.beranda') }}">Beranda</a>
    <a href="#">User</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">Keluar</a>

    <br />
    @yield('content')

    <form action="{{ route('backend.logout') }}" id="keluar-app" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>