<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatalogMarksRequest extends Request
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
                    'slug' => 'required|unique:car_marks',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required',
                    'name_rus' => 'required',
                    'slug' => 'required|unique:car_marks,slug,' . $this->input('mark_id'),
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
