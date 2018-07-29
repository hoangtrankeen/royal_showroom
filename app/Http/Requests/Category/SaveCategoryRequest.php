<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class SaveCategoryRequest extends FormRequest
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
            // rules, criteria
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|unique:categories,slug',
            'parent_id'      => 'required|max:255',
            'order'          => 'required|integer',
            'active'          => 'required|integer',
        ];
    }
}
