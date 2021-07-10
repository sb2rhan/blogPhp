<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

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
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->update($data);
        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('categories.products.index', $product->category);
    }
}
