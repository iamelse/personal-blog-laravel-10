<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/png">

    <!-- Load Boxicons CSS asynchronously -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" media="print" onload="this.media='all'">

    <!-- Load Font Awesome CSS asynchronously -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Inline critical CSS or load async (example: app.css) -->
    <link rel="stylesheet" href="{{ asset('assets/export-vite/css/app.css') }}" media="print" onload="this.media='all'">

    <!-- Load JavaScript files asynchronously -->
    <script src="{{ asset('assets/export-vite/js/app2.js') }}" defer></script>

    <title>{{ $title ?? env('APP_NAME') }}</title>

    <style>
        /* Fullscreen background with a semi-transparent overlay */
        body.loading::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #FFFFFF; /* White background */
            z-index: 9998; /* Just below the loader */
        }
    
        /* Loader styles */
        .loader {
            width: 50px;
            height: 50px;
            aspect-ratio: 1;
            --_c: no-repeat radial-gradient(farthest-side, #0dcaf0 92%, transparent);
            background: 
                var(--_c) top,
                var(--_c) left,
                var(--_c) right,
                var(--_c) bottom;
            background-size: 12px 12px;
            animation: l7 2s infinite linear;  /* Added infinite loop */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the loader */
            z-index: 9999; /* Ensure loader is on top of everything */
        }
    
        /* Define spinning animation */
        @keyframes l7 {
            from {
                transform: translate(-50%, -50%) rotate(0deg); /* Start at 0 degrees */
            }
            to {
                transform: translate(-50%, -50%) rotate(360deg); /* Rotate 360 degrees */
            }
        }
    
        /* Full screen, white background during loading */
        body.loading {
            background-color: white;
            height: 100vh; /* Ensure body takes full height */
            margin: 0;
            position: relative;
        }
    
        /* Hide the content while loading */
        body.loading #app {
            visibility: hidden;  /* Hide content */
        }
    
        /* Show the loader while page is loading */
        body.loading .loader {
            display: block; /* Show loader */
        }
    
        /* Once page is loaded, show content and hide loader */
        body.loaded #app {
            visibility: visible; /* Show content */
        }
    
        body.loaded .loader {
            display: none; /* Hide loader */
        }
    </style>
</head>