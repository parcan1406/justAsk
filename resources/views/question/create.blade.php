@extends('layouts.app')
@section('title','Create Question')
@section('content')
    <h2>Create Question</h2>
    @include('question._form', ['action' => route('question.store'), 'method' => 'POST'])
@endsection