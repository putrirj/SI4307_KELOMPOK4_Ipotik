<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('layout_title') | Ipotik</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('partial.navbar')

    @yield('layout_content')

    @include('partial.footer')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('layout_script_include')
    <script>
        function changePhoto(){
            $('.input-profile-photo').click();
        }

        var loadPhoto = function(event) {
            var output = document.getElementById('profile-photo-preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src)
            }
        };
        
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3000);

        @if (session('alert_type'))
            Swal.fire({
                icon: "{{ session('alert_type') }}",
                title: "{{ session('alert_message') }}"
            })
        @endif

        @yield('layout_script')
    </script>
</body>
</html>