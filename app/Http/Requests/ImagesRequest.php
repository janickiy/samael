<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImagesRequest extends Request
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
                    'image[]' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'category'  => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'image[]' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'category'  => 'required',
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
