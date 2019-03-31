<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SafaraIT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url("{{ asset('assets/img/edisonwl.png') }}"); 
                background-size: cover;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                /* color: #636b6f; */
                color:#FF4500;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                color:#7CFC00;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class='jumbotron text-center'>
                    <div class="flex-center position-ref full-height">
                        @if (Route::has('login'))
                        <div class="top-right links">
                                            @if (Auth::check())
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ url('/login') }}">Login</a>
                                <a href="{{ url('/register') }}">Register</a>
                            @endif
                        </div>
                        @endif

                    <div class="content">
                        <div class="title m-b-md">
                                <strong>Welcome to SafaraIT</strong>
                        </div>

                        <div class="links">
                            {{-- <a href="/home">Home</a>  --}}
                            <a href="/about"><strong>About</strong></a>
                            <a href="/services"><strong>Services</strong></a>
                            <a href="/members"><strong>Members</strong></a>
                            {{-- <a href="https://github.com/laravel/laravel">GitHub</a> --}}
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
