    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Web POS</title>
        <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
    </head>
    <body class="auth-body">
        <main class="auth-card">
            <div class="box auth-logo" role="img" aria-label="Logo"></div>
            <h1>Masuk ke Web POS</h1>

            @if(session('success'))
                <p class="alert-success">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}"
                        autocomplete="username" autofocus required>
                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        autocomplete="current-password" required>
                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <label class="remember">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>

                <button type="submit" class="btn btn-block">Masuk</button>
                {{-- @if ($errors->any())
                <div>
                        ($errors->first() as $error)
                            <li class="error">{{ $error }}</li>
                        
                </div>
                @endif --}}
            </form>
        </main>

    </body>
    </html>
