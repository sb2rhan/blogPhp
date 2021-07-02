<a href="{{ route('products.index') }}">Back to products</a>

<main id="product" style="display:flex; flex-flow:column; align-items: center">
    <h1>{{ $product->title }}</h1>
    <div style="display:inherit; flex-flow: row">
        <div style="">
            <img alt="{{ $product->title }} image" style="min-width: 120px;" width="260px" src="{{ $product->image_link }}">
        </div>
        <div style="align-items: center">
            <p>
                Created at: {{ $product->created_at }},
                In storage: {{ $product->count }} left
            </p>
            <p>
                {{$product->description}}
            </p>
            <b>Price: {{ $product->price }}</b>

            <a href="{{ route('products.edit', $product) }}">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="post">
                @csrf @method('delete')
                <button>Delete</button>
                <!-- We cannot create delete with anchors cuz they are for get requests -->
            </form>
        </div>
    </div>
</main>
