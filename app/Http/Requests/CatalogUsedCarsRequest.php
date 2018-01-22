<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatalogUsedCarsRequest extends Request
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
                    'mark'  => 'required',
                    'model' => 'required',
                    'price' => 'required|numeric',
                    'year'  => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'gearbox' => 'required',
                    'drive'   => 'required',
                    'engine_type' => 'required',
                    'power' => 'required|numeric',
                    'body'  => 'required',
                    'wheel' => 'required',
                    'color' => 'required',
                    'salon' => 'required',
                    'image[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'mark'  => 'required',
                    'model' => 'required',
                    'price' => 'required|numeric',
                    'year'  => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'gearbox' => 'required',
                    'drive'   => 'required',
                    'engine_type' => 'required',
                    'power' => 'required|numeric',
                    'body'  => 'required',
                    'wheel' => 'required',
                    'color' => 'required',
                    'salon' => 'required',
                    'image[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
