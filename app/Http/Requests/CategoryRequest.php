<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048' ,  'mimes:jpg,jpeg,png,webp' ],
            'parent_id' => ['nullable','exists:categories,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'الإسم مطلوب.',
            'name.string' => 'الإسم يجب أن يكون نص.',
            'name.max' => 'الإسم لا يمكن أن يزيد عن 255 حرف.',

            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت (2048 كيلوبايت).',
            'image.mimes' => 'صيغة الصورة يجب أن تكون jpg, jpeg, png, أو webp.',
            'parent_id.exists' => 'القسم الأب المحدد غير موجود.',

        ];
    }
}
