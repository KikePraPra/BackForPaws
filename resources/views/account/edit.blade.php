
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Cuenta</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
        </style>
    @endif
</head>
<body>
    <main class="bg-white">
        <article class="min-h-screen flex items-center justify-center flex-col rounded-3xl bg-white px-7 pt-3 z-10">
            <h1 class="text-3xl font-bold text-green-700">Edit Account</h1>
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

                <form method="POST" action="{{ route('account.update', $account->id) }}" enctype="multipart/form-data" class="flex flex-col w-max mx-auto font-sans">
                    @csrf
                    @method('PUT')

                    <label>Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $account->email) }}" required
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-5 text-left pl-2 text-lg font-semibold"/>

                    <label class="mt-6">Username:</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $account->username) }}" required
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-5 text-left pl-2 text-lg font-semibold"/>

                    <label class="mt-6">Tel:</label>
                    <input type="number" name="phone_number" id="phone_number" value="{{ old('phone_number', $account->phone_number) }}" required
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-5 text-left pl-2 text-lg font-semibold"/>

                    <label class="mt-6">Password (leave blank to not change)</label>
                    <input type="password" name="password" id="password"
                        class="rounded-lg border-2 border-green-600 h-12 w-80 mt-5 text-left pl-2 text-lg font-semibold"/>

                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mt-9"></label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-green-500 transition duration-150">
                        <div class="space-y-1 text-center">
                            <div id="imagePreviewContainer" class="{{ $account->profile_picture ? '' : 'hidden' }} mb-4">
                                <img id="imagePreview"
                                     src="{{ $account->profile_picture ? asset('storage/' . $account->profile_picture) : '' }}"
                                     class="mx-auto max-h-48 rounded-lg shadow-lg"
                                     alt="Image preview">
                            </div>
                            <svg id="uploadIcon" class="mx-auto h-12 w-12 text-gray-400 {{ $account->profile_picture ? 'hidden' : '' }}" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col items-center">
                                <label for="profile_picture" class="cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 px-3 py-2 mb-2">
                                    Upload an image
                                </label>
                                <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                                    class="block w-full text-sm text-gray-500 mt-2">
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF until 2MB</p>
                        </div>
                    </div>
                    @error('profile_picture')
                        <span class="text-red-600 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="mt-8 pb-5.5 h-12 mb-5 w-80 rounded-2xl pt-2 bg-green-600 text-white border-2 font-fredoka cursor-pointer border-green-600 hover:bg-transparent hover:text-green-700 duration-400">
                        Save changes
                    </button>
                    <a href="{{ route('account.index') }}"
                    class="mt-1 bg-green-700 text-white font-bold px-6 py-2 rounded-2xl w-full max-w-xs text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
                     Back
                    </a>
                </form>
            </div>
        </article>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('profile_picture');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const uploadIcon = document.getElementById('uploadIcon');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        imagePreview.src = reader.result;
                        imagePreviewContainer.classList.remove('hidden');
                        uploadIcon.classList.add('hidden');
                    });
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreviewContainer.classList.add('hidden');
                    uploadIcon.classList.remove('hidden');
                }
            });
        });
    </script>
</body>
</html>