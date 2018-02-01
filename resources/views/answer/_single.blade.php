<div class="answer commentable has-comment-form editable"
     data-commentable-id="{{ $answer->id }}"
     data-commentable-type="{{ get_class($answer) }}">
    <div class="answer-header row">
        <div class="col-md-3 user-block">
            <a href="{{ route('user.profile', ['user' => $answer->user, 'entity' => 'questions']) }}">
                @include('partials.user-block', ['user' => $answer->user])
            </a>
        </div>
        <div class="col-md-4 pull-right info text-right">
            <span class="edit-date">{{ $answer->updated_at }}</span>
            @can('remove', $answer)
                <a href="#delete-modal"
                   data-toggle="modal"
                   class="delete-btn"
                   data-url="{{ route('answer.destroy', $answer) }}">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            @endcan
        </div>
    </div>
    <div class="col-md-12 row  answer-content">
        <span class="@editClass($answer)" data-edit-url="{{ route('answer.update.property', $answer) }}">{{ $answer->content }}</span>
    </div>
    <div class="row">
        <div class="col-md-3 pull-right text-right">
            @include('comment._buttons')
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @include('comment._container')
        </div>
    </div>
    <hr>
    @include('partials.modal.delete-confirm', ['msg' => 'Are you sure you want to delete this answer?'])
</div>