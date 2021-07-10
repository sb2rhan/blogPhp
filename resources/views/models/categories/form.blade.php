@extends('layouts.main')

@section('content')
    <?php
    $category = $category ?? null;
    ?>

    <h1>@if($category) Edit @else New @endif category</h1>

    <form action="{{ $category ? route('categories.update', $category) : route('categories.store') }}" method="post">
        @csrf

        @if($category) <!-- Doing this because form doesn't support PUT method -->
            @method('put')
        @endif

        <div>
            <label for="name">Name:</label>
            <input value="{{ old('name', $category->name ?? null) }}" type="text" id="name" name="name" />
            <!-- old function returns old data when page reloaded -->
            @error('name')
            <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" >{{ old('description', $category->description ?? null) }}</textarea>
            @error('description')
            <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>

        <button>@if($category) Edit @else Create @endif</button>
    </form>
@endsection
