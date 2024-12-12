<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CateRoomRequest extends FormRequest
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
            'room_type'=>'required',
            'adult'=>'required',
            'children'=>'required',
            'size'=>'required',
            'status'=>'required',
            'image'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute không được để trống'
        ];
    }
    public function attributes()
    {
        return [
            'room_type'=>'Loại phòng',
            'adult'=>'Người lớn',
            'children'=>'Trẻ em',
            'size'=>'Kích thước',
            'status'=>'Tình trạng',
            'image'=>'Hình'
        ];
    }
}
