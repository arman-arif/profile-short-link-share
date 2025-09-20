<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Ariful">
    <meta name="keywords" content="Profile Share">

    <title>{{ config('app.name', "App") }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    @vite([
        'resources/assets/admin/js/app.js',
        'resources/assets/admin/scss/app.scss'
    ])
</head>

<body>
    <div class="wrapper">
        <x-admin.navbar />

        <div class="main">
            <x-admin.header/>

            <main class="content">
                @yield('content')
            </main>

            <x-admin.footer/>
        </div>
    </div>

    <x-alerts />
</body>

</html>
