@extends('layouts.main')

@section('content')
    <h1 class="display-5">{{ $category->name }} products</h1>
    @if ($category->description)
    <p class="h3">Note: {{ $category->description }}</p>
    @endif
    <div class="d-flex justify-content-start">
        <a href="{{ route('categories.index') }}">All categories</a>
        @can('create', App\Models\Product::class)
            <a href="{{ route('categories.products.create', $category) }}" class="mx-5">New product</a>
        @endcan
    </div>
    <hr>
    @if($products->isNotEmpty())

        <ul class="d-flex flex-wrap">
            @foreach($products as $product)
                <li style="list-style-type: none; margin-left: 15px; margin-right: 15px">
                    <a href="{{ route('products.show', $product) }}">
                        <div class="d-flex flex-column justify-content-center">
                            @if($product->image_link)
                                <img style="min-width: 120px;" alt="{{ $product->title }}"
                                     height="140px" width="160px"
                                     src="{{ \Storage::url($product->image_link) ?? "https://cdn3.iconfinder.com/data/icons/abstract-1/512/no_image-512.png" }}">
                            @else
                                <img style="min-width: 120px;" alt="No image" height="140px" width="160px"
                                     src="https://cdn3.iconfinder.com/data/icons/abstract-1/512/no_image-512.png" />
                            @endif
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
