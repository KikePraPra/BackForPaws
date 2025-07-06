<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <main class="bg-white min-h-screen flex items-center justify-center">
        <article class="min-h-screen flex items-center justify-center flex-col rounded-3xl bg-white px-4 sm:px-7 pt-3 z-10 w-full">
            <h1 class="text-3xl font-bold text-green-700 mb-8 text-center w-full">Reportes</h1>
            <a href="{{ route('report.create') }}"
               class="bg-green-700 text-white font-bold p-2 rounded mb-7 w-full max-w-md text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
                Crear nuevo reporte
            </a>
            <div class="w-full max-w-md">
                <ul class="flex flex-col gap-4 w-full">
                    @forelse ($reports as $report)
                        <li class="text-green-900 rounded-lg px-4 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <span class="font-semibold mr-2">Nombre de la mascota:</span>
                                <a href="{{ route('report.show', $report->id) }}"
                                   class="font-semibold text-green-700 hover:underline break-all">
                                    {{ $report->pet_name }}
                                </a>
                                <br>
                                <span class="text-gray-500 text-sm">Reportado por:</span>
                                <a href="{{ route('account.show', $report->account_id) }}"
                                   class="text-green-700 font-semibold hover:text-green-900 break-all">
                                    {{ optional($report->account)->username ?? 'N/A' }}
                                </a>
                            </div>
                            <div class="flex gap-2 mt-2 sm:mt-0 flex-shrink-0">
                                <a href="{{ route('report.edit', $report->id) }}"
                                   class="bg-green-600 hover:bg-green-800 text-white px-3 py-1 rounded transition text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('report.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Está seguro que quieres eliminar este reporte?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded transition text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">There are no registered reports.</li>
                    @endforelse
                </ul>
            </div>
        </article>
    </main>
</body>
</html>
