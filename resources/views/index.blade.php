<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <noscript>
        <p>Enable JS, please!</p>
    </noscript>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f5f8fa" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" rel="script" defer></script>

    <title>{{ config('app.name')  }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="vertical-center">
        <div id="app" class="container">
            <div class="row">
                <div class="offset-1 col-10">
                    <flash-message></flash-message>
                </div>
            </div>

            <router-view></router-view>
        </div>
    </div>
</body>

</html> 