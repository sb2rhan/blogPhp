<h1>Posts</h1>
<a href="{{ route('posts.create') }}">Add post</a>
<hr>
@if($posts->isNotEmpty())

    <ol>
        @foreach($posts as $post)
            <li value="{{ $post->id }}">
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ol>

@else
    <div>
        There are no posts! Come back later 🙂
    </div>
@endif
