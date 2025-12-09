<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('page.title', config('app.name'))</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    {{-- <link rel="stylesheet" href="{{asset('css/reset.css')}}"> --}}

    <!-- FONTS -->
    <link rel="preconnect" href="{{ asset('https://fonts.googleapis.com')}}">
    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com')}}" crossorigin>
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Philosopher&family=Raleway:wght@400;500;600&family=Roboto:wght@300;700;900&display=swap')}}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/routers/index.js' ])

</head>

<body id="app">
    <div class="max-w-screen-2xl flex-wrap mx-auto ">
        @yield('content')
    </div>
</body>

</html>
