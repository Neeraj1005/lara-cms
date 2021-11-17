<?php

namespace Neeraj1005\Cms\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'category' => ['nullable', 'exists:cms_categories,id'],
            'picture' => ['nullable', 'image'],
            'postType' => ['required', Rule::in(['draft','publish'])],
        ];
    }
}
