<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('feed') }}">Just Ask</a>
        </div>
        <div id="navbar"  class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(auth()->user()->hasRole('admin'))
                    <li><a href="{{route('admin.topic.index')}}">Admin Panel</a></li>
                @endif
                <li><a {{ Request::route()->getName() == 'feed'? 'class=active' : '' }} href="{{route('feed')}}">Home</a></li>
                <li><a {{ Request::route()->getName() == 'question.create'? 'class=active' : '' }} href="{{ route('question.create') }}">Add Question</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('user.profile', ['user' => auth()->user(), 'entity' => 'questions'] ) }}">
                        @if(isset(auth()->user()->profile_avatar))
                            <img class="profile-image-small img-circle"
                                 src="{{ asset('storage/' . auth()->user()->profile_avatar)}}">
                        @else
                            <img class="profile-image-small img-circle"
                                 src="{{ asset('images/profile-image.png')}}">
                        @endif

                        {{ auth()->user()->name }}
                    </a>
                </li>
                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a></li>

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
        @yield('alerts')
    </div>
    <div class="col-md-3">
        @section('left-menu')
            <div class="main-sidebar col-md-9">
                <div class="feed row">
                    <div class="col-md-4">
                        <div class="row">
                            <a class="feed-link" href="{{ route('feed') }}">Feeds</a>
                        </div>
                    </div>
                    <div class="col-md-3 pull-right">
                        <a class="edit-link" href="{{ route('user.profile', ['user' => auth()->user(), 'entity' => 'topics']) }}">Edit</a>
                    </div>
                </div>
                <div class="topics row">
                    @foreach(auth()->user()->topics as $topic)
                        <div class="topic">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <a href="{{ route('topic.show', $topic->name) }}">{{ $topic->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @show
    </div>
    <div class="col-md-9">
        @yield('content')
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script')
</body>
</html>