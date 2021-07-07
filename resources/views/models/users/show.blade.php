@extends('layouts.main')

@section('content')

    <h1>{{ $user->name }}</h1>

    <h3>Posts</h3>

    @if($posts->isEmpty())
        <p>No posts are there!</p>
    @else
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <hr>

    <h3>Comments</h3>

    @forelse($comments as $comment)
        <p>
            {{ $comment->content }}
            <br>
            <small>
                <a href="{{ route('posts.show', $comment->post) }}">
                    {{ $comment->post->title }}
                </a>
            </small>
        </p>
    @empty
        <p>No comments yet!</p>
    @endforelse

@endsection
