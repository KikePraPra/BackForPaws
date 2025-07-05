<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
<main class="bg-white min-h-screen flex items-center justify-center">
    <article class="flex flex-col items-center justify-center rounded-3xl bg-white px-7 pt-10 z-10 w-full max-w-md min-h-[500px] shadow-lg">
        <h1 class="text-3xl font-bold text-green-700 mb-8 text-center w-full">Report Details</h1>
        <div class="flex flex-col gap-4 w-full max-w-xs mx-auto">
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Pet Name:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $report->pet_name }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Pet Age:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $report->pet_age ?? 'N/A' }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Animal Type:</span>
             <span class="font-semibold text-green-900 text-lg">
                {{ optional($report->animal)->name ?? optional($report->animal)->specie ?? 'N/A' }}
             </span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Last Seen Place:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $report->last_place }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">State:</span>
                <span class="font-semibold text-green-900 text-lg">{{ $report->pet_state }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Description:</span>
                <span class="font-semibold text-green-900 text-lg break-all">{{ $report->description }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-gray-500 text-sm">Reported by:</span>
                <a href="{{ route('account.show', $report->account_id) }}"
                   class="text-green-700 font-semibold hover:text-green-900 break-all">
                    {{ optional($report->account)->username ?? 'N/A' }}
                </a>
            </div>
            @if($report->pet_image)
                <div class="flex flex-col items-center mt-4">
                    <span class="text-gray-500 text-sm mb-2">Pet Image:</span>
                    <img src="{{ asset('storage/' . $report->pet_image) }}" class="max-h-40 rounded-lg shadow border border-green-200 object-cover" alt="Pet image">
                </div>
            @endif
        </div>
        <a href="{{ route('report.index') }}"
           class="mt-8 bg-green-700 text-white font-bold px-6 py-2 rounded-2xl w-full max-w-xs text-center hover:bg-transparent hover:text-green-700 border-2 border-green-700 transition duration-400 block">
            Back
        </a>