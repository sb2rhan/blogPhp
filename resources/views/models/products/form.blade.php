@extends('layouts.main')

@section('content')
<?php
$product = $product ?? null;
?>

<h1>@if($product) Edit @else New @endif product</h1>

<form action="{{ $product ? route('products.update', $product) : route('categories.products.store', $category) }}"
      method="post" enctype="multipart/form-data">
    @csrf

    @if($product) <!-- Doing this because form doesn't support PUT method -->
        @method('put')
    @endif

    <div>
        <label for="title">Title:</label>
        <input value="{{ old('title', $product->title ?? null) }}" type="text" id="title" name="title" />
        <!-- old function returns old data when page reloaded -->
        @error('title')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" >{{ old('description', $product->description ?? null) }}</textarea>
        @error('description')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="image_link">Image:</label>
        <input accept="image/*" value="{{ old('image_link', $product->image_link ?? null) }}" type="file" id="image_link" name="image_link" />
        @error('image_link')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="count">Count:</label>
        <input value="{{ old('count', $product->count ?? null) }}" type="number" id="count" name="count" />
        @error('count')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="price">Price:</label>
        <input value="{{ old('price', $product->price ?? null) }}" type="text" id="price" name="price" />
        @error('price')
        <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <button>@if($product) Edit @else Create @endif</button>
</form>
@endsection
