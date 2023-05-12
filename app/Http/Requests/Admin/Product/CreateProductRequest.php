<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            "category_id"=>"required",
            "image"=>"required",
            "images"=>"required",
            "brand"=>"required",
            "price"=>"required",
            "quantity"=>"required",
            "description"=>"required",
            "size_id"=>"required",
            "color_id"=>"required",
            "status"=>"required",
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"Không được để trống tên sản phẩm",
            "category_id.required"=>"Không được để trống danh mục sản phẩm",
            "image.required"=>"Không được để trống ảnh bìa sản phẩm",
            "images.required"=>"Không được để trống ảnh sản phẩm",
            "brand.required"=>"Không được để trống thương hiệu sản phẩm",
            "price.required"=>"Không được để trống giá sản phẩm",
            "quantity.required"=>"Không được để trống số lượng sản phẩm",
            "description.required"=>"Không được để trống mô tả sản phẩm",
            "size_id.required"=>"Không được để trống size sản phẩm",
            "color_id.required"=>"Không được để trống màu sắc sản phẩm",
            "status.required"=>"Không được để trống trạng thái sản phẩm",
        ];
    }
}
