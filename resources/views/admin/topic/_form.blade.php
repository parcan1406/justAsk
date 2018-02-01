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
    <form action="{{ $action }}" method="post">
        {{csrf_field()}}
        {{method_field($method)}}
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $topic->name ?? null) }}">
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $topic->description ?? null)  }}">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>