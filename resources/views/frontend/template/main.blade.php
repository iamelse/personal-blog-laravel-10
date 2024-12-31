<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body class="loading">

    <!-- Loader -->
    <div class="loader" id="loader"></div>

    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.body.classList.remove('loading');
                document.body.classList.add('loaded');
            }, 2000);
        });
    </script>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });
    </script>

</body>

</html>