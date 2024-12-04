<?php

namespace App\Http\Requests\Admin;

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
            'id_user'=>'required',
            'name'=>'required',
            'price'=>'required',
            'id_category'=>'required',
            'status'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute không được để trống',
            'image'=>':attribute không phải là ảnh',
            'mimes'=>':attribute phải định dạng jpeg,png,jpg,gif',
            'max'=>':attribute quá kích thước'
        ];
    }
    public function attributes()
    {
        return [
            'id_user'=>'Id user',
            'name'=>'Tên sản phẩm',
            'price'=>'Giá',
            'id_category'=>'Danh mục',
            'status'=>'Trạng thái',
            'image'=>'Hình ảnh'
        ];
    }
}
