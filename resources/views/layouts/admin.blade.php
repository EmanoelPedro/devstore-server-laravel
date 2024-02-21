<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="https://file.myfontastic.com/7c66L3N5Hf3ankhnbVmWwN/icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex justify-between">
        @include('admin.layouts.left-sidebar')
        @include('admin.layouts.navigation')

        <x-alert-popup type="info">
            <x-slot name="header">
                <strong class="font-bold">Error</strong>
            </x-slot>
            <x-slot name="message">
                <span class="block sm:inline">Please fill in all the fields</span>
            </x-slot>
        </x-alert-popup>
        <x-alert-popup type="success">
            <x-slot name="header">
                <strong class="font-bold">Error</strong>
            </x-slot>
            <x-slot name="message">
                <span class="block sm:inline">Please fill in all the fields</span>
            </x-slot>
        </x-alert-popup>

        <x-alert-popup type="warning">
            <x-slot name="header">
                <strong class="font-bold">Error</strong>
            </x-slot>
            <x-slot name="message">
                <span class="block sm:inline">Please fill in all the fields</span>
            </x-slot>
        </x-alert-popup>

        <x-alert-popup type="error">
            <x-slot name="header">
                <strong class="font-bold">Error</strong>
            </x-slot>
            <x-slot name="message">
                <span class="block sm:inline">Please fill in all the fields</span>
            </x-slot>
        </x-alert-popup>
        <div class="min-h-screen ml-64 w-full max-w-full bg-gray-100 mb:ml-3">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="max-w-[calc(100%-64px)] mb:max-w-full">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>
        <script src="{{asset('js/functions/functions.js')}}"></script>
        {{$scripts ?? ''}}
    </body>
</html>
