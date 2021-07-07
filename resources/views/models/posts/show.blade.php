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
                Author: <a href="{{ route('users.show', $post->user) }}">{{ $post->user->name }}</a>
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

        <hr>

        <h3>Comments</h3>
        @can('create', App\Models\Comment::class)
        <form action="{{ route('comments.store', $post) }}" method="post">
            @csrf

            <label>
                <textarea name="content">{{ old('content') }}</textarea>
            </label>
            @error('content')
            <span>{{ $message }}</span>
            @enderror

            <div>
                <button>Add comment</button>
            </div>
        </form>
        @endcan

        @forelse($post->comments as $comment)
            <p>
                <small>
                    <span>
                        @if($comment->user)
                            <a href="{{ route('users.show', $comment->user) }}">
                                {{ $comment->user->name }}
                            </a>
                        @else
                            DELETED
                        @endif
                    </span>
                    @can('delete', $comment)
                    <a href="#" class="delete-comment-link" data-form-id="delete-comment-{{ $comment->id }}">
                        Delete comment
                    </a>
                    @endcan
                </small>
                <br>
                <span>
                    {{ $comment->content }}
                </span>
            </p>

            @can('delete', $comment)
            <form id="delete-comment-{{ $comment->id }}"
                  action="{{ route('comments.destroy', $comment) }}" method="post">
                @csrf @method('delete')
                <button>Delete comment</button>
            </form>
            @endcan
        @empty
            <div>No comments there...</div>
        @endforelse
    </div>

    <script>

        let links = document.querySelectorAll('.delete-comment-link');

        links.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                let id = link.dataset.formId;

                if (id) {
                    let form = document.getElementById(id);
                    if (form)
                        form.submit();
                }
            })
        })
    </script>
@endsection
