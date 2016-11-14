<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskMaster</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
    @yield('head')
</head>
<body>
    @include('includes/header')
    <main id="siteContent">
        <div class="container">
            @yield('content')
        </div>
    </main>
    @include('includes/footer')
    @include('includes/flash-message')
    <script src="{{ URL::asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
