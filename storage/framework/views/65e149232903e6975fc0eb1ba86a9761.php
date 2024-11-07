<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset(mix('img/log-viewer-32.png', 'vendor/log-viewer'))); ?>">

    <title>Log Viewer<?php echo e(config('app.name') ? ' - ' . config('app.name') : ''); ?></title>

    <!-- Style sheets-->
    <link href="<?php echo e(asset(mix('app.css', 'vendor/log-viewer'))); ?>" rel="stylesheet" onerror="alert('app.css failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')">
</head>

<body class="h-full px-3 lg:px-5 bg-gray-100 dark:bg-gray-900">
<div id="log-viewer" class="flex h-full max-h-screen max-w-full">
    <router-view></router-view>
</div>

<!-- Global LogViewer Object -->
<script>
    window.LogViewer = <?php echo json_encode($logViewerScriptVariables, 15, 512) ?>;

    // Add additional headers for LogViewer requests like so:
    // window.LogViewer.headers['Authorization'] = 'Bearer xxxxxxx';
</script>
<script src="<?php echo e(asset(mix('app.js', 'vendor/log-viewer'))); ?>" onerror="alert('app.js failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')"></script>
</body>
</html>
<?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\vendor\opcodesio\log-viewer\src/../resources/views/index.blade.php ENDPATH**/ ?>