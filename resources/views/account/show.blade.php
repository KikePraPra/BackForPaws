<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles de la Cuenta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
<main class="bg-white min-h-screen flex items-center justify-center">
    <article class="flex flex-col items-center justify-center rounded-3xl bg-white px-7 pt-10 z-10 w-full max-w-md min-h-[500px]">
        <h1 class="text-3xl font-bold text-green-700 mb-8 text-center w-full">Detalles de la Cuenta</h1>
        <div class="flex flex-col gap-4 w-full max-w-xs mx-auto">
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Username:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $account->username }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Email:</span>
                <span class="font-semibold text-green-900 text-lg break-all">{{ $account->email }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Tel:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $account->phone_number }}</span>
            </div>
            @if($account->profile_picture)
                <div class="flex flex-col items-center mt-4">
                    <span class="text-gray-500 text-sm mb-2">profile picture:</span>
                    <img src="{{ asset('storage/' . $account->profile_picture) }}" class="max-h-40 rounded-lg shadow border border-green-200 object-cover" alt="Foto de perfil">
                </div>
            @endif
        </div>
        <a href="{{ route('account.index') }}"
           class="mt-8 bg-green-700 text-white font-bold px-6 py-2 rounded-2xl w-full max-w-xs text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
            Back
        </a>
    </article>
</main>
</body>
</html>