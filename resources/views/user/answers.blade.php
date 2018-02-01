@extends('user.profile')
@section('entity-content')
<div class="answers">
    <h2>Answers</h2>
    @if(count($answers) > 0)
        @foreach($answers as $answer)
            <div class="question row">
                <div class="question-header col-md-10">
                    <div class="title">
                        <a href="{{ route('question.show', $answer->question) }}"><span>{{ $answer->question->title }}</span></a>
                    </div>
                    <a class="rel-topic" href="{{ route('topic.show', $answer->question->topic->name) }}">{{ $answer->question->topic->name }}</a>
                </div>
            </div>
            <div class="answer row">
                <div class="answer-header col-md-12">
                    <div class="col-md-6">
                        <div class="row">
                            @include('partials.user-block', ['user' => $answer->user])
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        {{$answer->updated_at}}
                    </div>
                </div>
                <div class="answer-content col-md-10 more">
                    {{ $answer->content }}
                </div>
            </div>
            <hr>
        @endforeach
        {{ $answers->links() }}
    @else
        <div>
            No Answers Yet
        </div>
    @endif
</div>
@endsection