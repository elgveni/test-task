@php
    $config = [
        'data_source' => config('app.data_source'),
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test task</title>
    <script>
        window.config = @json($config);
    </script>
    @vite([
        'resources/css/reset.css',
        'resources/css/fonts.css',
        'resources/css/variables.css',
        'resources/css/app.css',
        'resources/css/components/table.css',
        'resources/css/components/side-modal.css',
    ])

    <!-- external -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    @vite([
        'resources/js/app.js',
    ])
</body>
</html>

