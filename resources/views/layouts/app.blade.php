<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

{{--    Font awesome--}}
    <script src="https://kit.fontawesome.com/b5346fc162.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles

</head>
<body>

{{--style="overflow-x: hidden;"--}}

    <div id="app">
            <div class="row stoppingPadding">
                <div class="col-2" style="padding-left: 0 !important;">
                    <x-side-bar/>
                </div>

                <div class="col-9">
                    <div class="container">
                    <main >
                        @include('flash-message')

                        @yield('content')
                    </main>
                </div>
            </div>
    </div>
    @livewireScripts

{{--js--}}
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
</html>
