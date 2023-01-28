<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:products,code' . ($this->routeIs('products.update') ? (',' . $this->product->id) : ""),
            'name' => 'required',
            'stock' => ($this->routeIs('products.update') ? 'nullable' : "required|numeric"),
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'image' => 'nullable|image|max:' . config('files.max_image_size'),
            'info' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'unit_id' => 'nullable|exists:units,id',
        ];
    }
}
