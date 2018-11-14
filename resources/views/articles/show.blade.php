@extends('app')

@section('content')

    <h1>{{$article->title}}</h1>
    <h3>Author: {{$article->user->name}}</h3>

    <article class="">

        {{$article->body}}

    </article>

@endsection
