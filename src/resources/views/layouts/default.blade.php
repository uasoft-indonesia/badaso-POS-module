<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Badaso Pos @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
</head>

<body>
    <div id="pos-app">
        <pos-main></pos-main>
    </div>
    <script src="{{ mix('js/badaso-pos.js') }}"></script>
</body>

</html>
