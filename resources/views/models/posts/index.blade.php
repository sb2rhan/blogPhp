@extends('layouts.main')

@section('content')
    <h1>Posts</h1>
    <div class="d-flex justify-content-start">
        <a href="{{ route('categories.index') }}">See categories of products</a>
        @can('create', App\Models\Post::class)
            <a href="{{ route('posts.create') }}" class="mx-5">Add post</a>
        @endcan
    </div>
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
