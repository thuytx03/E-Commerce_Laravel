<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required",
            "status"=>"required"
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"Không được để trống tên danh mục",
            "status.required"=>"Không được để trống trạng thái danh mục",
        ];
    }
}
