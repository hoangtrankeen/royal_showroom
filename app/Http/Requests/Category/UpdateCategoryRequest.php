<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name'           => 'required|max:190',
            'slug'           => 'required|alpha_dash|max:255|unique:categories,slug,'.$this->category,
            'parent_id'      => 'required|max:255',
            'order'          => 'required|integer',
            'active'          => 'required|integer',
        ];
    }
}
