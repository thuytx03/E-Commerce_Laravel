<?php

namespace App\Http\Requests\Client\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CreateCartRequest extends FormRequest
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
            'size_id'=>'required',
            'color_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'size_id.required'=>'Không được để trống size',
            'color_id.required'=>'Không được để trống color',
        ];
    }
}
