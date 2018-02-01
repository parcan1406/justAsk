<div class="user-block">
    <a href="{{ route('user.profile', ['user' => $user, 'entity' => 'questions']) }}">
        @if(isset($user->profile_avatar))
            <img class="profile-image-small img-circle" src="{{ asset('storage/' . $user->profile_avatar)}}">
        @else
            <img class="profile-image-small img-circle" src="{{ asset('images/profile-image.png')}}">
        @endif
        <span>{{ $user->name }}</span>
    </a>
</div>
