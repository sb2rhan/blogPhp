@extends('layouts.main')

@section('content')
    <h1>Products</h1>
    @can('create', App\Models\Product::class)
        <a href="{{ route('products.create') }}" style="padding-right: 20px;">New product</a>
    @endcan
    <a href="{{ route('posts.index') }}">Go to posts</a>
    <hr>
    @if($products->isNotEmpty())

        <ul style="display: flex; flex-flow: wrap">
            @foreach($products as $product)
                <li style="list-style-type: none; margin-left: 15px; margin-right: 15px">
                    <a href="{{ route('products.show', $product) }}">
                        <div style="display: flex; flex-flow: column; justify-content: center">
                            <img style="min-width: 120px;" alt="{{ $product->title }}"
                                 height="140px" width="160px"
                                 src="{{ $product->image_link ?? "https://cdn3.iconfinder.com/data/icons/abstract-1/512/no_image-512.png" }}">
                            <p>{{ $product->title }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    @else
        <div>
            There are no products! Come back later 🙂
        </div>
    @endif
@endsection
