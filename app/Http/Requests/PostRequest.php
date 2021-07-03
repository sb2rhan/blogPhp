<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueTitle = Rule::unique('posts', 'title');

        if ($post = $this->route('post'))
            $uniqueTitle->ignoreModel($post);

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                $uniqueTitle
            ],
            'content' => ['required', 'string', 'min:10']
        ];
    }
}
