<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        $uniqueTitle = Rule::unique('products', 'title');

        if ($product = $this->route('product'))
            $uniqueTitle->ignoreModel($product);

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                $uniqueTitle
            ],
            'description' => ['nullable'],
            'image_link' => ['nullable', 'file'],
            'count' => ['int', 'min:0'],
            'price' => ['min:0'],
            'category_id' => ['nullable', 'int', Rule::exists((new Category())->getTable(), 'id')]
        ];
    }
}
