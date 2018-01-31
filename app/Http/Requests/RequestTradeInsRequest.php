<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequestTradeInsRequest extends Request
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
                    'phone' => 'required',
                    'mark'  => 'mark',
                    'model' => 'model',
                    'year'  => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'trade_in_mark'  => 'required|numeric',
                    'trade_in_model' => 'required|numeric',
                    'trade_in_complectation' => 'required|numeric',
                    'agree' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'  => 'required',
                    'phone' => 'required',
                    'mark'  => 'mark',
                    'model' => 'model',
                    'year'  => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'trade_in_mark'  => 'required|numeric',
                    'trade_in_model' => 'required|numeric',
                    'trade_in_complectation' => 'required|numeric',
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
