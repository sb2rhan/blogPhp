@extends('layouts.main')

@section('content')
    <main class="container d-flex flex-column" id="product">
        <div class="row">
            <div class="col-4 d-flex justify-content-center">
                <a class="btn btn-link" href="{{ route('categories.products.index', $product->category) }}">Back to products</a>
            </div>
            <div class="col-8">
                <h1 class="display-4">{{ $product->title }}</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            @if($product->image_link)
            <div class="col-5 d-flex flex-column justify-content-center align-items-end">
                    <img alt="{{ $product->title }} image"
                         style="min-width: 120px;" width="260px"
                         src="{{ \Storage::url($product->image_link) }}">
                    <form class="mt-4" action="{{ route('products.deleteImage', $product) }}" method="post">
                        @csrf @method('delete')
                        <button class="btn btn-outline-warning">Delete image</button>
                    </form>
            </div>
            @endif
            <div class="col-7">
                <p>
                    Created at: {{ $product->created_at }} <br>
                    In storage: {{ $product->count }} left <br>
                    Seller: {{ $product->user->name }}

                </p>
                <p>
                    <span class="h3">Description</span> <br>
                    <span class="lead">{{$product->description}}</span>
                </p>
                <b>Price: {{ $product->price }}</b>

                <div class="d-flex py-3">
                    @can('update', $product)
                        <a class="btn btn-primary" href="{{ route('products.edit', $product) }}">Edit</a>
                    @endcan

                    @can('delete', $product)
                        <form class="ps-4" action="{{ route('products.destroy', $product) }}" method="post">
                            @csrf @method('delete')
                            <button class="btn btn-danger">Delete</button>
                            <!-- We cannot create delete with anchors cuz they are for get requests -->
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </main>
@endsection
