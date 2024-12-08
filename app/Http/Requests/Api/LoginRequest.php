<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
<<<<<<< HEAD
<<<<<<< HEAD
            'required'=>':attribute không được để trống',
=======
            'required'=>':attribute Không được để trống',
>>>>>>> 3de6771 (Initial commit)
=======
            'required'=>':attribute Không được để trống',
>>>>>>> bf66bb5 (Initial commit)
            'email.email' => ':attribute sai định dạng'
        ];
    }
}
