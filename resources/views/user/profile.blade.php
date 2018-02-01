@extends('layouts.app')
@section('title', $user->name . ' Profile')
@section('left-menu')
    <div class="sidebar">
        <div class="list-group">
        <span href="#" class="list-group-item">
            @if ($user->id == auth()->user()->id)
                My Info
            @else
                {{ $user->name }} Info
            @endif
        </span>
            <a href="{{ route('user.profile', ['user' => $user, 'entity' => 'questions']) }}" class="list-group-item {{ Request::route()->getName() == 'user.profile' && Request::route()->parameter('entity') == 'questions' ? 'active' : '' }}">
                <i class="fa fa-question" aria-hidden="true"></i> Questions <span class="badge">{{ $user->questions_count }}</span>
            </a>
            <a href="{{ route('user.profile', ['user' => $user, 'entity' => 'answers']) }}" class="list-group-item {{ Request::route()->getName() == 'user.profile' && Request::route()->parameter('entity') == 'answers' ? 'active' : '' }}">
                <i class="fa fa-commenting-o" aria-hidden="true"></i> Answers <span class="badge">{{ $user->answers_count }}</span>
            </a>
            <a href="{{ route('user.profile', ['user' => $user, 'entity' => 'topics']) }}" class="list-group-item {{ Request::route()->getName() == 'user.profile' && Request::route()->parameter('entity') == 'topics' ? 'active' : '' }}">
                <i class="fa fa-book" aria-hidden="true"></i> Topics <span class="badge">{{ $user->topics_count }}</span>
            </a>
        </div>
    </div>
@endsection
@section('alerts')
    @parent
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section('css')
    @parent
    <link href="{{ mix('css/profile.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="profile" data-user-id="{{ $user->id }}">

        <div class="profile-header row">
            <div class="col-md-3">
                <div class="profile-avatar">
                    @if(isset($user->profile_avatar))
                        <img class="profile-image" src="{{ asset('storage/' . $user->profile_avatar)}}">
                    @else
                        <img class="profile-image" src="{{ asset('images/profile-image.png')}}">
                    @endif

                    @can('update', $user)
                        <div class="change-avatar">
                            <span>change avatar</span>
                        </div>
                    @endcan
                </div>
                @can('update', $user)
                    <form method="post" action="{{ route('user.update.avatar', $user) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" class="form-control" name="avatar" id="avatar-file">
                        <button class="btn btn-primary update-avatar-btn"  type="submit">Update</button>
                    </form>
                @endcan
            </div>
            <div class="col-md-4">
                <div>
                    <span class=" @editClass($user)" data-edit-url="{{ route('user.update.property', $user) }}" id="username">{{ $user->name }}</span>
                </div>
                <div>
                    <span class="@editClass($user)" data-edit-url="{{ route('user.update.property', $user) }}" id="email">{{ $user->email }}</span>

                </div>
                <div>
                    <span class="@editClass($user)" data-edit-url="{{ route('user.update.property', $user) }}" id="add-info">{{ $user->add_info }}</span>
                </div>
            </div>
        </div>

        <div class="entity-content">
            @yield('entity-content')
        </div>

    </div>
@endsection