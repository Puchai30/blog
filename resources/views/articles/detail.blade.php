@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $articler->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $articler->created_at->diffForHumans() }}
                    Category: <b>{{ $articler->category->name }}</b>
                </div>
                <p class="card-text">{{ $articler->body }}</p>
                <a class="btn btn-warning" href="{{ url("/articles/delete/$articler->id") }}">
                    Delete
                </a>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($articler->comments) }})</b>
            </li>
            @foreach ($articler->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>

        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $articler->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
    </div>
@endsection
