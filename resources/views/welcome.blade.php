<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Webtres | Test</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-dark bg-secondary">
                <a class="navbar-brand ml-5" href="#">Administrador usuarios</a>
            </nav>
            <users></users>
        </div>
    </body>
</html>
