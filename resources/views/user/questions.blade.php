@extends('user.profile')
@section('entity-content')
<div class="questions">
    <h2>Questions</h2>
    @if(count($questions) > 0)
        @foreach($questions as $question)
            <div class="question row">
                <div class="question-header col-md-10">
                    <div class="title">
                        <span>{{ $question->title }} </span>
                        @can('update', $question)
                            <a href="{{route('question.edit', $question)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        @endcan
                    </div>
                    <a class="rel-topic" href="#">{{ $question->topic->name }}</a>

                </div>
            </div>
            <hr>
        @endforeach
        {{ $questions->links() }}
    @else
        <div>
            No Questions yet.
        </div>
    @endif
</div>
@endsection
