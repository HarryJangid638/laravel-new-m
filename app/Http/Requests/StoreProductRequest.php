<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'promotional_price' => 'nullable|numeric|min:0|lte:regular_price',
            'currency' => 'required|string|max:8',
            'tax_rate' => 'nullable|numeric|min:0',
            'shipping_width' => 'nullable|numeric|min:0',
            'shipping_height' => 'nullable|numeric|min:0',
            'shipping_weight' => 'nullable|numeric|min:0',
            'shipping_fee' => 'nullable|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'sub_category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}


