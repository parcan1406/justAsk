@extends('layouts.app')
@section('title', $topic->name)
@section('css')
    @parent
    <link href="{{ mix('css/topic.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="topic-header">
        <h2>{{ $topic->name }}</h2>
        <div class="topic-description"><i>{{ $topic->description }}</i></div>
    </div>
    <div class="questions">
        @if (count($topic->questions))
            @foreach($topic->questions as $question)
                @include('topic._question', compact('question'))
                <hr>
            @endforeach
        @else
            <div class="empty-questions">
                No questions yet
            </div>
        @endif
    </div>

@endsection