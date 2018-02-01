@extends('layouts.admin')
@section('title','Create Topic')
@section('content')
    <h2>Create Topic</h2>
    @include('admin.topic._form', ['action' => route('admin.topic.store'), 'method' => 'POST'])
@endsection