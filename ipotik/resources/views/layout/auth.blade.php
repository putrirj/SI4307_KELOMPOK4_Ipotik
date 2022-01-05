<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('layout_title') | Ipotik</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body class="d-flex flex-column min-vh-100  align-content-center justify-content-center align-self-center">
    <header>
        <nav class="py-2 border-bottom bg-primary fixed-top">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item"><a href="{{ route('index') }}" class="nav-link p-0 active fw-bold text-white"
                            aria-current="page"><img class="logo" src="{{ asset('assets/images/logo.png') }}" class="h-auto"></a></li>
                </ul>
                <ul class="nav me-auto">
                    <li class="nav-item"><a href="{{ route('index') }}" class="nav-link text-white px-2">Beranda</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="mt-sm-5 mb-5 p-3" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <div class="row">
                <div class="col-12 col-lg-7 justify-content-center align-self-center">
                    <img src="{{ asset('assets/images/svg_login.png') }}" class="w-100 h-auto" alt="" srcset="">
                </div>
                <div class="col-12 col-lg-5 justify-content-center align-self-center">
                    @yield('layout_content')
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3000);
    </script>
</body>
</html>