<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdate extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->id,
            'name' => 'required',
//            'bank_id' => 'required',
//            'bank_account_id' => 'required|unique:users,bank_account_id,'.$this->id,
//            'bank_account_name' => 'required',
            'address' => 'required',
            'veryfyinfo' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'veryfyinfo' => 'Xác nhận thông tin',
            'bank_account_id' => 'Số tài khoản',
            'bank_account_name' => 'Tên tài khoản',
            'address' => 'Địa chỉ',
            'name' => 'Nickname',
        ];
    }
}
