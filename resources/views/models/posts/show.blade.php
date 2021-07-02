@extends('layouts.main')

@section('content')
    <h1>{{ $post->title }}</h1>
    <a href="{{ route('posts.index') }}">All posts</a>
    <div>
        <div>
            <small>
                Created at: {{ $post->created_at }}
            </small>
        </div>
        <div>
            <small>
                Author: {{ $post->user->name }}
            </small>
        </div>
        <p>
        {{$post->content}}
        </p>
        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}">Edit</a>
        @endcan

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf @method('delete')
                <button>Delete</button>
                <!-- We cannot create delete with anchors cuz they are for get requests -->
            </form>
        @endcan
    </div>
@endsection
