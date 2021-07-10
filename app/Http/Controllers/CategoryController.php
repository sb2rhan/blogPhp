<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category', [
            'except' => ['index', 'show']
        ]);
    }

    public function index()
    {
        $categories = Category::query()
            ->with('products')
            ->orderBy('name')
            ->get();

        return view('models.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('models.categories.form');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        DB::table('categories')->insert($data);

        return redirect()->route('categories.index');
    }

    /*public function show(Category $category)
    {
        return view('models.categories.show', [
            'category' => $category
        ]);
    }*/

    public function edit(Category $category)
    {
        return view('models.categories.form', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update($data);

        return redirect()->route('categories.index', $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
