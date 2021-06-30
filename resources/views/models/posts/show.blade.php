<h1>{{ $post->title }}</h1>
<a href="{{ route('posts.index') }}">All posts</a>
<div>
    <small>
        Created at: {{ $post->created_at }}
    </small>
    <p>
    {{$post->content}}
    </p>

    <a href="{{ route('posts.edit', $post) }}">Edit</a>
    <form action="{{ route('posts.destroy', $post) }}" method="post">
        @csrf @method('delete')
        <button>Delete</button>
        <!-- We cannot create delete with anchors cuz they are for get requests -->
    </form>
</div>
