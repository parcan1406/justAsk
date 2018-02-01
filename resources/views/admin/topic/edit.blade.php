@extends('layouts.admin')
@section('title','Edit Topic')
@section('content')
    <h2>Edit Topic</h2>
    @include('admin.topic._form', ['action' => route('admin.topic.update', $topic), 'method' => 'put'])
@endsection