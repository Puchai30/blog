@extends('layouts.app')

@section('title')
    <title>{{ $category->name }}</title>
@endsection

@section('content')
    <div class="container">
        <h1>Category: {{ $category->name }}</h1>
        <hr>
        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">Read More</a>
                </div>
            </div>
        @endforeach
        {{ $articles->links() }}
    </div>
@endsection
