<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'blog_name'        => 'required|min:3',
            'short_describe'   => 'required',
            'detail_describe'   => 'required',
            'img'               => 'required',
            'status'            => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'blog_name.*'        => 'Tên bài viết Phải Từ 3 Ký Tự',
            'short_describe.*'    => 'Mô tả ngắn không được để trống',
            'detail_describe.*'    => 'Mô tả chi tiết không được để trống',
            'img.*'            => 'Hình ảnh không được để trống',
            'status.*'            => 'Tình trạng không được để trống',
        ];
    }
}
