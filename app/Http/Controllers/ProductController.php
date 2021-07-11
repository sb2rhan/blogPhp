<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product', [
            'except' => ['index', 'show']
        ]);
    }

    public function index(Category $category)
    {
        $products = Product::query()
            ->where('category_id', $category->id)
            ->with('user')
            ->get();

        return view('models.products.index', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function create(Category $category)
    {
        return view('models.products.form', [
            'category' => $category
        ]);
    }

    public function store(ProductRequest $request, Category $category)
    {
        $product = auth()->user()
            ->products()->create($request->validated());

        $product->category()->associate($category);
        $this->uploadImage($product, $request);
        $product->save();

        return redirect()->route('products.show', $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('models.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('models.products.form', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage
     * @throws ValidationException
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->update($data);
        $this->uploadImage($product, $request);

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $category = $product->category;
        $this->removeImage($product);
        $product->delete();
        return redirect()->route('categories.products.index', $category);
    }

    function deleteImage(Product $product) {
        $this->authorize('update', $product);

        $this->removeImage($product);
        $product->update([
            'image_link' => null
        ]);

        return back();
    }

    /**
     * @throws ValidationException
     */
    function uploadImage(Product $product, ProductRequest $request) {
        if (!$request->hasFile('image_link'))
            return;

        # store image in /storage/app/public/products
        $path = $request->file('image_link')->store('public/products');

        if ($path === false)
            throw ValidationException::withMessages([
                'image' => 'Sorry, server error. Image path problem'
            ]);

        $this->removeImage($product);
        $product->fill(['image_link' => $path])->save();
    }

    function removeImage(Product $product): bool {
        if (!$product->image_link)
            return false;
        return Storage::delete($product->image_link);
    }
}
