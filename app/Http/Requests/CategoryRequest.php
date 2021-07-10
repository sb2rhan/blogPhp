<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueName = Rule::unique('categories', 'name');

        # needed when editing
        if ($category = $this->route('category'))
            $uniqueName->ignoreModel($category);

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $uniqueName
            ],
            'description' => []
        ];
    }
}
