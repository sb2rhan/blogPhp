@extends('layouts.main')

@section('content')
    <h1>Categories</h1>
    @can('create', App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="pe-5">New category</a>
    @endcan
    <a href="{{ route('posts.index') }}">Go to posts</a>
    <hr>
    @if($categories->isNotEmpty())

        <div class="card-deck">
            @foreach($categories as $category)
                <a href="{{ route('categories.products.index', $category) }}">
                    <div class="card mx-5">
                        <div class="card-header">
                            <p class="lead">{{ $category->name }}</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <p>{{ $category->description }}</p>
                                <div class="ms-auto d-flex flex-row">
                                    @can('update', $category)
                                        <a class="btn btn-primary mx-2" href="{{ route('categories.edit', $category) }}">Edit</a>
                                    @endcan

                                    @can('delete', $category)
                                        <form action="{{ route('categories.destroy', $category) }}" method="post">
                                            @csrf @method('delete')
                                            <button class="btn btn-danger mx-2">Delete</button>
                                            <!-- We cannot create delete with anchors cuz they are for get requests -->
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    @else
        <div>
            There are no categories!
        </div>
    @endif
@endsection
