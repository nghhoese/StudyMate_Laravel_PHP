<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>StudyMató</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-left">
            <audio autoplay>
                <source src="studymate.ogg" type="audio/ogg">
                <source src="studymate.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    StudyMató
                </div>

                <div class="links">
                    <a href="admin-dashboard">Admin Omgeving</a>
                    <a href="guest-dashboard">Dashboard</a>
                    <a href="deadline-dashboard">Deadline Manager</a>
                </div>
            </div>
        </div>
    </body>
</html>
