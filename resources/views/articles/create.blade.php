@extends('app')

@section('content')

    <h1>Create New article</h1>
    <hr/>

    {!! Form::open(['url'=>'articles']) !!}
        @include('articles.form', ['submitButtonText' => 'Add article'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection
