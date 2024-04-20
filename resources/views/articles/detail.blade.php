@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $articler->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $articler->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $articler->body }}</p>
                <a class="btn btn-warning" href="{{ url("/articles/delete/$articler->id") }}">
                    Delete
                </a>
            </div>
        </div>
    </div>
@endsection
