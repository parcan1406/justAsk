<div class=" col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Answer</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('answer.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="question" value="{{ $question->id }}">
                <div class="form-group">
                    <textarea name="content" class="form-control" cols="30" rows="7"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>