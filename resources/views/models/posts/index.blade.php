@extends('layouts.main')

@section('content')
    <h1>Posts</h1>
    @can('create', App\Models\Post::class)
        <a href="{{ route('posts.create') }}">Add post</a>
    @endcan
    <hr>
    @if($posts->isNotEmpty())

        <ol>
            @foreach($posts as $post)
                <li value="{{ $post->id }}">
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                    <small>
                        {{ $post->user->name }}
                    </small>
                </li>
            @endforeach
        </ol>

    @else
        <div>
            There are no posts! Come back later 🙂
        </div>
    @endif
@endsection
