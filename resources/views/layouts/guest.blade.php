<html>
<head>
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<header>
    <h3 class="text-center">Just Ask</h3>
</header>

<div class="container">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script')
</body>
</html>