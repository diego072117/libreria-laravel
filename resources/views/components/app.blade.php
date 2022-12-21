<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'Biblioteca' }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>Document</title>
</head>
<body>
    {{-- Menu --}}
    
    <x-menu/>
    {{-- @include('components.menu') --}}

{{-- Content --}}
<main id="app">
    {{$slot}}
    {{-- {{$sum}} --}}
</main>
    

</body>
</html>