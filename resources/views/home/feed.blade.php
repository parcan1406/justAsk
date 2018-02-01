@extends('layouts.app')
@section('title', 'Feed')
@section('css')
    @parent
    <link href="{{ mix('css/topic.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if(count($questions) > 0)
        @foreach($questions as $question)
            <div class="question row">
                <div class="col-md-10">
                    <div class="question-header row">
                        <div class="col-md-4">
                            @include('partials.user-block', ['user' => $question->user])
                        </div>
                        <div class="col-md-3 pull-right">
                            {{ $question->updated_at }}
                        </div>

                    </div>
                    <div class="col-md-10">
                        <div class="title">
                                <a href="{{ route('question.show', $question) }}">{{ $question->title }}</a>
                        </div>
                        <a class="rel-topic" href="{{ route('topic.show', $question->topic->name) }}">{{ $question->topic->name }}</a>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
        {{ $questions->links() }}
    @elseif(count(auth()->user()->topics))
        <div class="empty-questions">
            No questions yet.
        </div>
    @else
        <div class="empty-questions">
           <p>
               You do not have any topics. To view the information you are interested in, please <a href="{{ route('user.profile', ['user' => auth()->user(), 'entity' => 'topics']) }}">add</a>   some topics.
           </p>
        </div>
    @endif
@endsection