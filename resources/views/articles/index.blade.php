@extends('layouts.app')

@section('title')
<title>All Blog</title>
@endsection


@section('content')
    <div class="container">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

         {{-- Search Bar --}}
         <form action="{{ route('articles.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search articles..." name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        {{-- Display Articles --}}
        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="card-subtitle mb-2 text-muted small">
                        {{ $article->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="btn btn-info" href="{{ url("/articles/detail/$article->id") }}">
                        View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        {{ $articles->links() }}
    </div>
@endsection
