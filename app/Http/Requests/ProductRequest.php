<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id'
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku,' . $this->product?->id
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'purchase_price' => [
                'required',
                'numeric'
            ],

            'selling_price' => [
                'required',
                'numeric'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'minimum_stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'image' => [
                'nullable',
                'image',
                'max:2048'
            ],
        ];
    }
}