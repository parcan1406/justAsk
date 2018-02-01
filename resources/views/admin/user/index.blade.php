@extends('layouts.admin')
@section('title','Users')
@section('content')
    <h2>Users</h2>
    <table class="table table-striped admin">
        <thead>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Register date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.modal.delete-confirm', ['msg' => 'Are you sure you want to delete this topic?'])
@endsection