<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CarModificationsRequest extends Request
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
                    'name'  => 'required',
                    'body_type' => 'required',
                    'year_begin' => 'required|numeric',
                    'year_end' => 'required|numeric',

                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'  => 'required',
                    'body_type' => 'required',
                    'year_begin' => 'required|numeric',
                    'year_end' => 'required|numeric',
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
