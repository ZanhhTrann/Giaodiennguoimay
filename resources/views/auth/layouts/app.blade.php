<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NA BRIDAL</title>
    <!-- Link Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link animate style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Link script the Carousel && Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <!-- Link script Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!-- ==========================LINK FILES IN FOLDERS========================== -->
    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="{{asset('imgs/logo_website.png')}}">
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{asset('css/layouts_css/style.css')}}">
    <link rel="stylesheet" href="{{asset("css/layouts_css/header.css")}}">
    <link rel="stylesheet" href="{{asset('css/layouts_css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts_css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/pages/products.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}
    <!-- Link Responsive -->
    <link rel="stylesheet" href="{{asset('css/responsive/responsive.css')}}">
    <style>.header_menu .home a{color: var(--blue)}</style>
</head>
<body>
    @yield('header')
    {{-- main content --}}
    @yield('content')
    {{-- app footer layouts --}}
    @include('auth.layouts.includes.footer')
    {{-- <script src="{{asset('js/main.js')}}"></script> --}}
    <script src="{{asset('js/owl_carousel.js')}}"></script>
    <script>
        setTimeout(function() {
        var statusNotification = document.getElementById('statusNotification');
        if (statusNotification) {
            statusNotification.classList.add('hide');
        }

        var errorNotification = document.getElementById('errorNotification');
        if (errorNotification) {
            errorNotification.classList.add('hide');
        }
    }, 5000);
    </script>

    <style>
        .notification {
            border-radius:10px;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 12;
            max-width: 380px; /* Giới hạn chiều rộng */
            word-wrap: break-word; /* Tự động xuống dòng nếu quá chiều rộng */
            white-space: pre-line;
            transition: opacity 0.5s ease;
        }

        .notification.hide {
            opacity: 0;
        }

        .status {
            background-color: #4CAF50;
            color: white;
        }

        .error {
            background-color: #f44336;
            color: white;
        }

        .warning {
            background-color: #ff9800;
            color: white;
        }
</body>
</html>
