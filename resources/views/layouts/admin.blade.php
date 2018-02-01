<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('admin.topic.index')}}">Admin Panel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a {{ Request::route()->getName() == 'admin.topic.index'? 'class=active' : '' }} href="{{route('admin.topic.index')}}">Topics</a></li>
                <li><a {{ Request::route()->getName() == 'admin.user.index'? 'class=active' : '' }}  href="{{route('admin.user.index')}}">Users</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('feed')}}">Go to Site</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="alerts">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if (session()->has('info'))
            <div class="alert alert-info">{{ session()->get('info') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
    </div>


    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script')
</body>
</html>