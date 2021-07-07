@extends('layouts.main')

@section('content')
<?php
$post = $post ?? null;
?>

<h1>@if($post) Edit @else New @endif post</h1>

<form enctype="multipart/form-data" action="{{ $post ? route('posts.update', $post) : route('posts.store') }}" method="post">
    @csrf


    @if($post) <!-- Doing this because form doesn't support PUT method -->
        @method('put')
    @endif

    <div>
        <label for="title">Title:</label>
        <input value="{{ old('title', $post->title ?? null) }}" type="text" id="title" name="title" required autofocus/>
        <!-- old function returns old data when page reloaded -->
        @error('title')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required>{{ old('content', $post->content ?? null) }}</textarea>
        @error('content')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="image">Image of post:</label>
        <input type="file" name="image" id="image" accept="image/*" />
        @error('image')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <button>@if($post) Edit @else Create @endif</button>
</form>
@endsection
