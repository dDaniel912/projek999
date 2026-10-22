<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>Login | PMI Perdana Media Investama</title>
  <link
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@1,500;1,600&family=Inter:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="auth-body">
  <main class="page">
    <section class="left">
      <header class="brand">
        <h1>PMI|PERDANA MEDIA INVESTAMA</h1>
      </header>

      <div class="hero">
        <div class="monitor" aria-hidden="true">
          <div class="screen"><span class="logo"></span><span class="divider"></span><span class="bar"></span></div>
          <div class="stand"></div>
        </div>
        <p class="tagline">Kelola Penjualan, Stok, Laporan, dan Pelanggan lebih mudah</p>
      </div>
    </section>

    @if(session('success'))
      <p class="alert-success">{{ session('success') }}</p>
    @endif

    <section class="right">
      <form id="loginform" autocomplete="on" method="POST" action="{{ route('login') }}">
        @csrf
        <label for="user">Email/Username</label>
        <input class="field" id="email" name="email" type="email" value="{{old('email')}}" autocomplete="username"
          autofocus required>
        @error('email')
          <small class="error">{{ $message }}</small>
        @enderror
        <label for="pass">Password</label>
        <input class="field" id="password" name="password" type="password" autocomplete="current-password" required>
        @error('password')
          <small class="error">{{ $message }}</small>
        @enderror
        <button class="btn" type="submit">LOGIN</button>
      </form>
    </section>
  </main>
</body>

</html>