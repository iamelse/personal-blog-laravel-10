<!DOCTYPE html>
<html lang="en">

   @include('partials.head')

   <body>
      <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
      <div id="app">
        
        @include('partials.sidebar')

         <div id="main" class='layout-navbar navbar-fixed'>
            <header>
               
                @include('partials.navbar')

            </header>
        
            @yield('content')
            
            @include('partials.footer')

         </div>
      </div>
      <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
      <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
      <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
   </body>
</html>