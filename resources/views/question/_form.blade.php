<div class="col-md-6">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ $action }}" method="post" class="create-question">
        {{csrf_field()}}
        {{method_field($method)}}
        <div class="form-group">
            <label>Topic</label>
            <select id="topic-select"  name="topic" class="form-control">
                <option></option>
                @foreach($topics as $topic)
                    @if((isset($question) ? $question->topic_id : old('category_id',-1)) == $topic->id)
                        <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                    @else
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $question->title ?? null) }}">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea type="text" name="content" class="form-control">{{ old('content', $question->content ?? null)  }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>