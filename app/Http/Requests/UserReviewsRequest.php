<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserReviewsRequest extends Request
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
                    'author'  => 'required|max:255',
                    'email'   => 'email',
                    'message' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'author'  => 'required|max:255',
                    'email'   => 'email',
                    'message' => 'required',
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
