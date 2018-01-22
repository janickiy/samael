<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CarModelsRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required',
                    'name_rus' => 'required',
                    'id_car_mark' => 'required|numeric',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required',
                    'name_rus' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            default:
                break;
        }
        return [
            //
        ];
    }
}
