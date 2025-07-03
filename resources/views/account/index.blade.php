<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accounts</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <main class="bg-white min-h-screen flex items-center justify-center">
        <article class="min-h-screen flex items-center justify-center flex-col rounded-3xl bg-white px-4 sm:px-7 pt-3 z-10 w-full">
            <h1 class="text-3xl font-bold text-green-700 mb-8 text-center w-full">Accounts</h1>
            <a href="{{ route('account.create') }}"
               class="bg-green-700 text-white font-bold p-2 rounded mb-7 w-full max-w-md text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
                Create New Account
            </a>
            <div class="w-full max-w-md">
                <ul class="flex flex-col gap-4 w-full">
                    @forelse ($accounts as $account)
                        <li class="text-green-900 rounded-lg px-4 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <span class="font-semibold mr-2">Username:</span>
                                <a href="{{ route('account.show', $account->id) }}"
                                   class="text-green-700 font-semibold hover:text-green-900 break-all">
                                    {{$account->username}}
                                </a>
                            </div>
                            <div class="flex gap-2 mt-2 sm:mt-0 flex-shrink-0">
                                <a href="{{ route('account.edit', $account->id) }}"
                                   class="bg-green-600 hover:bg-green-800 text-white px-3 py-1 rounded transition text-sm">
                                    Edit
                                </a>
                              
                      <form action="{{ route('account.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this account?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded transition text-sm">
                            Delete
                        </button>
                        </form>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">There are no registered accounts.</li>
                    @endforelse
                </ul>
            </div>
        </article>
    </main>
</body>
</html>
