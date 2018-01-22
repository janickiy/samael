<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|max:255',
                        'email' => 'required|email|max:255|unique:users',
                        'password' => 'required|confirmed|min:6',
                        'role' => 'required',
                        'avatar' => 'mimes:jpg,jpeg,png,gif|max:1024'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|max:255',
                        'email' => 'required|email|max:255|unique:users,email,' . $this->input('user_id'),
                        'password' => 'confirmed|min:6',
                        'role' => 'required',
                        'avatar' => 'mimes:jpg,jpeg,png,gif|max:1024'
                    ];
                }
            default:
                break;
        }

        return [
        ];
    }

}
