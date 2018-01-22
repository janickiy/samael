<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CallbacksRequest extends Request
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
                    'name'  => 'required|max:255',
                    'phone'   => 'required|max:255',
                    'to_time' => 'required',
                    'from_time' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'  => 'required|max:255',
                    'phone'   => 'required|max:255',
                    'to_time' => 'required',
                    'from_time' => 'required',
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
