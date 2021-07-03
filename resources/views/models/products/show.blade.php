@extends('layouts.main')

@section('content')
    <main class="container d-flex flex-column" id="product">
        <div class="row">
            <div class="col-4 d-flex justify-content-center">
                <a class="btn btn-link" href="{{ route('products.index') }}">Back to products</a>
            </div>
            <div class="col-8">
                <h1 class="display-4">{{ $product->title }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-4 d-flex justify-content-end">
                <img alt="{{ $product->title }} image"
                     style="min-width: 120px;" width="260px"
                     src="{{ $product->image_link ?? "https://cdn3.iconfinder.com/data/icons/abstract-1/512/no_image-512.png" }}">
            </div>
            <div class="col-8">
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

                <div class="d-flex flex-row ">
                @can('update', $product)
                    <a class="btn btn-primary" href="{{ route('products.edit', $product) }}">Edit</a>
                @endcan

                @can('delete', $product)
                    <form action="{{ route('products.destroy', $product) }}" method="post">
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
