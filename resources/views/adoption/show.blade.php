<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adoption Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
<main class="bg-white min-h-screen flex items-center justify-center">
    <article class="flex flex-col items-center justify-center rounded-3xl bg-white px-7 pt-10 z-10 w-full max-w-md min-h-[500px] shadow-lg">
        <h1 class="text-3xl font-bold text-green-700 mb-8 text-center w-full">Adoption Details</h1>
        <div class="flex flex-col gap-4 w-full max-w-xs mx-auto">
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Pet Name:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $adoption->pet_name }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Pet Age:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $adoption->pet_age ?? 'N/A' }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Animal Type:</span>
             <span class="font-semibold text-green-900 text-lg">
                {{ optional($adoption->animal)->name ?? optional($adoption->animal)->specie ?? 'N/A' }}
             </span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Lugar de reunión:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $adoption->meeting_place }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Estado:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $adoption->pet_state }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Descripción:</span>
                <span class="font-semibold text-green-900 text-lg break-all">{{ $adoption->description }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">put Adoption by:</span>
                <a href="{{ route('account.show', $adoption->account_id) }}"
                   class="text-green-700 font-semibold hover:text-green-900 break-all">
                    {{ optional($adoption->account)->username ?? 'N/A' }}
                </a>
            </div>
            @if($adoption->pet_image)
                <div class="flex flex-col items-center mt-4">
                    <span class="text-gray-500 text-sm mb-2">Pet Image:</span>
                    <img src="{{ asset('storage/' . $adoption->pet_image) }}" class="max-h-40 rounded-lg shadow border border-green-200 object-cover" alt="Pet image">
                </div>
            @endif
        </div>
        <a href="{{ route('adoption.index') }}"
           class="mt-8 bg-green-700 text-white font-bold px-6 py-2 rounded-2xl w-full max-w-xs text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
            Back
        </a>