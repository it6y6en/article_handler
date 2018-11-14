@extends('app')

@section('content')

    <h1>Articles</h1>
    <hr/>

    @foreach ($articles as $article)
        <article class="">
            <h2>
                <!-- <a href="{{ action('ArticlesController@show', [$article->id]) }}">{{$article->title}}</a><br> -->
                <a href="{{ url('/articles', $article->id) }}">{{$article->title}}</a>
                <h5>by: {{ $article->user->name }}</h5>
                <h6><span><a href="{{ action('ArticlesController@edit', $article->id) }}">Edit</a></span></h6>

            </h2>

            <div class="body">
                {{$article->body}}

            </div>
        </article>
    @endforeach
        <hr/>
        <h3><a href="{{ action('ArticlesController@create') }}">Create New</a></h3>

@endsection
