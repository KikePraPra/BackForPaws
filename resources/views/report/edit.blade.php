<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Reporte</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="bg-white">
        <article class="min-h-screen flex items-center justify-center flex-col rounded-3xl bg-white px-7 pt-10 z-10">
            <h1 class="text-3xl font-bold text-green-700">Editar Reporte</h1>
            <div class="mt-11 flex flex-col gap-7">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('report.update', $report->id) }}" enctype="multipart/form-data" class="flex flex-col w-max mx-auto font-sans">
                    @csrf
                    @method('PUT')

                    <label class="mt-2">Cuenta:</label>
                    <select name="account_id" required class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold">
                        <option value="">Seleccione una cuenta</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ old('account_id', $report->account_id) == $account->id ? 'selected' : '' }}>
                                {{ $account->username }}
                            </option>
                        @endforeach
                    </select>

                    <label class="mt-6">Tipo de animal:</label>
                    <select name="animal_id" required class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold">
                        <option value="">Seleccione el animal</option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}" {{ old('animal_id', $report->animal_id) == $animal->id ? 'selected' : '' }}>
                                {{ $animal->name ?? $animal->specie }}
                            </option>
                        @endforeach
                    </select>

                    <label class="mt-6">Nombre de la mascota:</label>
                    <input type="text" name="pet_name" value="{{ old('pet_name', $report->pet_name) }}" required
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold"/>

                    <label class="mt-6">Edad de la mascota (años):</label>
                    <input type="number" name="pet_age" value="{{ old('pet_age', $report->pet_age) }}" min="0"
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold"/>

              <label class="mt-6">Último lugar donde fue visto:</label>
                <select name="last_place" required class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold">
                    <option value="">Seleccione una Provincia</option>
                    <option option value="San José" {{ old('last_place', $report->last_place) == 'San José' ? 'selected' : '' }}>San José</option>
                    <option value="Cartago" {{ old('last_place', $report->last_place) == 'Cartago' ? 'selected' : '' }}>Cartago</option>
                    <option value="Limón" {{ old('last_place', $report->last_place) == 'Limón' ? 'selected' : '' }}>Limón</option>
                    <option value="Puntarenas" {{ old('last_place', $report->last_place) == 'Puntarenas' ? 'selected' : '' }}>Puntarenas</option>
                    <option value="Heredia" {{ old('last_place', $report->last_place) == 'Heredia' ? 'selected' : '' }}>Heredia</option>
                    <option value="Alajuela" {{ old('last_place', $report->last_place) == 'Alajuela' ? 'selected' : '' }}>Alajuela</option>
                    <option value="Guanacaste" {{ old('last_place', $report->last_place) == 'Guanacaste' ? 'selected' : '' }}>Guanacaste</option>
                </select>


                    <label class="mt-6">Estado de la mascota:</label>
                    <select name="pet_state" required class="rounded-lg border-2 border-green-600 h-12 w-80 mt-2 pl-2 text-lg font-semibold">
                        <option value="">seleccione un estado</option>
                        <option value="Perdido" {{ old('pet_state', $report->pet_state) == 'Perdido' ? 'selected' : '' }}>Perdido</option>
                        <option value="Encontrado" {{ old('pet_state', $report->pet_state) == 'Encontrado' ? 'selected' : '' }}>Encontrado</option>
                    </select>

                    <label class="mt-6">Descripción:</label>
                    <textarea name="description" required rows="3"
                        class="rounded-lg border-2 border-green-600 w-80 mt-2 pl-2 text-lg font-semibold resize-none">{{ old('description', $report->description) }}</textarea>

                    <label for="pet_image" class="block text-sm font-medium text-gray-700 mt-9">Imagen de la mascota (opcional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-green-500 transition duration-150">
                        <div class="space-y-1 text-center">
                            <div id="imagePreviewContainer" class="{{ $report->pet_image ? '' : 'hidden' }} mb-4">
                                <img id="imagePreview"
                                     src="{{ $report->pet_image ? asset('storage/' . $report->pet_image) : '' }}"
                                     class="mx-auto max-h-48 rounded-lg shadow-lg"
                                     alt="Image preview">
                            </div>
                            <svg id="uploadIcon" class="mx-auto h-12 w-12 text-gray-400 {{ $report->pet_image ? 'hidden' : '' }}" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col items-center">
                                <label for="pet_image" class="cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 px-3 py-2 mb-2">
                                    Subir una imagen
                                </label>
                                <input id="pet_image" name="pet_image" type="file" accept="image/*"
                                    class="block w-full text-sm text-gray-500 mt-2">
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB (optional)</p>
                        </div>
                    </div>
                    @error('pet_image')
                        <span class="text-red-600 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="mt-8 mb-5 w-80 font-bold rounded-2xl py-3 bg-green-700 text-white border-2 font-fredoka cursor-pointer border-green-700 hover:bg-transparent hover:text-green-700 duration-400">
                        Guardar cambios
                    </button>
                    <a href="{{ route('report.index') }}"
                        class="mt-1 bg-green-700 text-white font-bold px-6 py-2 rounded-2xl w-full max-w-xs text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
                        Atrás
                    </a>
                </form>
            </div>
        </article>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('pet_image');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const uploadIcon = document.getElementById('uploadIcon');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('hidden');
                        uploadIcon.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreviewContainer.classList.add('hidden');
                    uploadIcon.classList.remove('hidden');
                }
            });
        });
    </script>