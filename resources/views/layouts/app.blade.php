<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta
         name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
         />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>{{ $title ?? env('APP_NAME') }}</title>
      <link rel="icon" href="{{ asset('tailadmin/images/favicon.ico') }}">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      
      @php
         $viteDevUrl = env('VITE_DEV_SERVER_URL', 'http://localhost:5173');
         $isDevServerRunning = false;

         try {
            $ch = curl_init($viteDevUrl);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            
            if (!curl_errno($ch)) {
                  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                  $isDevServerRunning = $http_code >= 200 && $http_code < 400;
            }
            
            curl_close($ch);
         } catch (\Exception $e) {
            $isDevServerRunning = false;
         }
      @endphp

      @if ($isDevServerRunning)
         {{-- Use Vite Dev Server --}}
         @vite(['resources/css/app.css', 'resources/js/app.js'])
      @else
         {{-- Load Production Build --}}
         @php
            $manifestPath = public_path('build/manifest.json');
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
         @endphp

         @if ($manifest && isset($manifest['resources/css/app.css'], $manifest['resources/js/app.js']))
            <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}" />
            <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
         @else
            {{-- Fallback if manifest.json is missing --}}
            <p style="color: red;">Error: Build files not found. Please run <code>npm run build</code>.</p>
         @endif
      @endif

   </head>
   <body
      x-data="{ 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
      x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
      :class="{'dark bg-gray-900': darkMode === true}"
      >
      <!-- ===== Page Wrapper Start ===== -->
      <div class="flex h-screen overflow-hidden">
         @include('partials.sidebar')
         <!-- ===== Content Area Start ===== -->
         <div
            class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
            >
            <!-- Small Device Overlay Start -->
            <div
               @click="sidebarToggle = false"
               :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
               class="fixed w-full h-screen z-9 bg-gray-900/50"
               ></div>
            <!-- Small Device Overlay End -->
            @include('partials.header')

            <!-- Page content -->
            @yield('content')

            <!-- Page-Specific Scripts -->
            @yield('bottom-scripts')
         </div>
         <!-- ===== Content Area End ===== -->
      </div>
      <!-- ===== Page Wrapper End ===== -->
   </body>
</html>