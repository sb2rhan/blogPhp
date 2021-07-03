<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()
            ->with('user')
            ->get();

        return view('models.products.index', [
            'products' => $products
        ]);
    }


    public function create()
    {
        $this->authorize('create', Product::class);
        return view('models.products.form');
    }

    public function store()
    {
        $this->authorize('create', Product::class);
        $data = request()->validate($this->rules());

        $product = auth()->user()
            ->products()->create($data);

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
        $this->authorize('update', $product);
        return view('models.products.form', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Product $product)
    {
        $this->authorize('update', $product);
        $data = request()->validate($this->rules($product));

        $product->update($data);
        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index');
    }

    /**
     * Rules to create/edit products
     * @param Product|null $product
     * @return array
     */
    protected function rules(Product $product = null): array {
        $uniqueTitle = Rule::unique('products', 'title');

        if ($product)
            $uniqueTitle->ignoreModel($product);

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                $uniqueTitle
            ],
            'description' => [],
            'image_link' => [],
            'count' => ['int', 'min:0'],
            'price' => ['min:0']
        ];
    }
}
