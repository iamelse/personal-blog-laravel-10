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
</head>