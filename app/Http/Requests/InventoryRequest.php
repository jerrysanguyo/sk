<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:inventory_categories,id',
            'quantity' => 'required|numeric',
            'cost' => 'required|numeric',
        ];
    }
}
