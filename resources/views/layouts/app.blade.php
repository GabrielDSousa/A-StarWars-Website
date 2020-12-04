<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>A StarWars Website</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

    @livewireStyles
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">

<div id='stars' class="overflow-hidden"></div>
<div id='stars2' class="overflow-hidden"></div>
<div id='stars3' class="overflow-hidden"></div>

@livewire('navigation-dropdown')

<!-- Page Heading -->
<header class="bg-transparent shadow text-center">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
    </div>
</header>

<!-- Page Content -->
<main>
    {{ $slot }}
</main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
