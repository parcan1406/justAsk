@extends('layouts.app')
@section('title','Edit Question')
@section('content')
    <h2>Edit Question</h2>
    @include('question._form', ['action' => route('question.update', $question), 'method' => 'put'])
@endsection