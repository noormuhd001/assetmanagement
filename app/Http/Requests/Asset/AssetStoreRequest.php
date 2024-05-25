<?php

namespace App\Http\Requests\Asset;

use Illuminate\Foundation\Http\FormRequest;
class AssetStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255',
            'model' => 'required|string',
            'category' => 'required|nullable|string|max:20',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'model.required' => 'The model field is required.',
            'model.string' => 'The model must be a string.',

            'category.string' => 'The category number must be a string.',
            'category.required' => 'The category field is required.',
            
        ];
    }
}
