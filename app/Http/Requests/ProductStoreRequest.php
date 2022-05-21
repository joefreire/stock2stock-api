<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;
use \Illuminate\Auth\Access\AuthorizationExceptio;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.sku' => 'required|unique:products',
            '*.sku.*.attributes' => 'required|array',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'sku.required' => 'Sku is required!',
            'attributes.required' => 'Attributes is required!',
        ];
    }
}