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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'long_description' => ['required', 'string', 'max:65535'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:png,gif,jpg,jpeg,svg', 'max:2048']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان المنتج مطلوب.',
            'title.string' => 'العنوان يجب أن يكون نص.',
            'title.max' => 'العنوان لا يمكن أن يزيد عن 255 حرف.',

            'short_description.required' => 'الوصف القصير مطلوب.',
            'short_description.string' => 'الوصف القصير يجب أن يكون نص.',
            'short_description.max' => 'الوصف القصير لا يمكن أن يزيد عن 255 حرف.',

            'long_description.required' => 'الوصف الطويل مطلوب.',
            'long_description.string' => 'الوصف الطويل يجب أن يكون نص.',

            'images.*.image' => 'كل ملف يجب أن يكون صورة.',
            'images.*.mimes' => 'الصيغ المسموحة هي: png, gif, jpg, jpeg, svg.',
            'images.*.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجا.',
        ];
    }
}
