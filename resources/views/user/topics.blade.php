@extends('user.profile')
@section('entity-content')
<div class="topics">
    <h2>Topics</h2>
    @can('update', $user)
        <form action="" method="post" class="add-topic">
            <div class="form-group">
                <label>Add Topic</label>
                <select id="topic-select"  name="topics[]" class="form-control" multiple>
                    <option></option>
                    @foreach($allTopics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    @endcan
    <div class="user-topics">
        {{--topics will be added via js--}}
        @include('partials.modal.delete-confirm', ['msg' => 'Are you sure you want to unsubscribe from this topic?'])
    </div>
</div>
@endsection
@section('script')
    @parent
    <script src="{{ mix('js/manage-topics.js') }}"></script>
@endsection
