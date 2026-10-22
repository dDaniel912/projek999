<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Profil Pengguna</h1>
        <div class="flex items-center gap-5 mb-8">

            <div class="w-20 h-20 rounded-full bg-indigo-600
                            text-white flex items-center justify-center
                            text-3xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <h2 class="text-xl font-semibold">
                    {{ $user->name }}
                </h2>
                <p class="text-gray-500">
                    {{ $user->email }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-sm text-gray-500">
                    Nama
                </label>

                <p class="font-medium">
                    {{ $user->name }}
                </p>
            </div>

            <div>
                <label class="text-sm text-gray-500">
                    Email
                </label>
                <p class="font-medium">
                    {{ $user->email }}
                </p>
            </div>
        </div>
        <div class="mt-8">
            <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
    </div>
    </div>

</body>

</html>