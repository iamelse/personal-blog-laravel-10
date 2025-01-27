<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>

    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

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