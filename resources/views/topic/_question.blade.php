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
        </div>
    </div>
</div>