@extends('layouts.app')

@section('title')
<title>Detail</title>
@endsection


@section('content')
    <div class="container">

        {{--Article--}}
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    By <b>{{ $article->user->name }}</b>
                    {{ $article->created_at->diffForHumans() }}
                    Category: <a href="{{ url("/categories/{$article->category->id}") }}" >{{ optional($article->category)->name }}</a>

                </div>

                <p class="card-text">{{ $article->body }}</p>

                <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                </a>

                <a class="btn btn-info" href="{{ url("/articles/{$article->id}/edit") }}">
                    Edit
                </a>
            </div>
        </div>

        {{-- Comments --}}
        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>

            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    {{ $comment->content }}

                    <div class="small mt-2">
                        By <b>{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Add Comment --}}
        @auth
        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
        @endauth

    </div>
@endsection
<?php>
