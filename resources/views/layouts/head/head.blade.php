<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/brain.png')}}">
<link rel="icon" type="image/png" href="{{asset('images/brain.png')}}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- FontAwesome dani -->
<script src="https://kit.fontawesome.com/c93d9f2851.js" crossorigin="anonymous"></script>

<link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/brain.png')}}">
<link rel="icon" type="image/png" href="{{asset('images/brain.png')}}">

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

@yield('styleSrc')

@yield('style')
