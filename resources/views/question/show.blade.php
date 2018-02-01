@extends('layouts.app')
@section('title', $question->title)
@section('css')
    @parent
    <link href="{{ mix('css/question.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="question commentable has-comment-form"
         data-commentable-id="{{ $question->id }}"
         data-commentable-type="{{ get_class($question) }}">
        <div class="row">
            <div class="col-md-4">
                @include('partials.user-block', ['user' => $question->user])
            </div>
        </div>
        <div class="row">
            <div class="question-header col-md-10">
                <div class="title">
                    <span>{{ $question->title }} </span>
                    @can('update', $question)
                        <a href="{{route('question.edit', $question)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    @endcan
                </div>
                <a class="rel-topic" href="{{ route('topic.show', $question->topic->name) }}">{{ $question->topic->name }}</a>

            </div>
        </div>
        <div class="row">
            <div class="question-content col-md-12">
                {{$question->content}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-default add-answer">Answer</button>
            </div>
            <div class="col-md-3 pull-right text-right">
                @include('comment._buttons')
            </div>

        </div>
        <div class="row">
            <div class="col-md-10">
                @include('comment._container')
            </div>
        </div>
        <div class="row add-answer-field">
            @include('answer._form', ['question' => $question])
        </div>
        <hr>
    </div>
    <div class="answers">
        <h3>Answers</h3>
        @foreach($answers as $answer)
            @include('answer._single', ['answer' => $answer])
        @endforeach
        {{ $answers->links() }}
    </div>
@endsection