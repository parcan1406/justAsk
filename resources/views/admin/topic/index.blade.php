@extends('layouts.admin')
@section('title','Topics')
@section('content')
    <h2>Topics</h2>

    <a href="{{route('admin.topic.create')}}" class="btn btn-primary">
        <i class="fa fa-plus" aria-hidden="true"></i>
        Add Topic
    </a>
    <table class="table table-striped admin">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->description }}</td>
                    <td class="actions">
                        <a href="{{route('admin.topic.edit', $topic)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a data-toggle="modal"
                           class="delete-btn"
                           href="#delete-modal"
                           data-url="{{ route('admin.topic.destroy', $topic) }}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $topics->links() }}
    @include('partials.modal.delete-confirm', ['msg' => 'Are you sure you want to delete this topic?'])
@endsection