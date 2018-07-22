<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SaveSimpleProductRequest extends FormRequest
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
            'slug'           => 'required|alpha_dash|min:5|max:255|unique:products,slug',
            'sku'            => 'required|min:5|max:255|unique:products,sku',
            'categories'     => 'nullable',
            'price'          => 'required|integer',
            'quantity'       => 'required|integer',
            'description'    => 'required',
            'details'        => 'required',
            'images.*'       => 'sometimes|required|image',
            'image'          => 'sometimes|required|image',
            'sort_order'     => 'required|integer',
            'type_id'        => 'required',
        ];
    }
}