<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatalogModificationsRequest extends Request
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
                    'id_model' => 'required|numeric',
                    'length' => 'numeric',
                    'width' => 'numeric',
                    'height' => 'numeric',
                    'trunk_volume_min' => 'numeric',
                    'trunk_volume_max' => 'numeric',
                    'tank_volume' => 'numeric',
                    'engine_displacement' => 'numeric',
                    'engine_displacement_working_value' => 'numeric',
                    'gears' => 'numeric',
                    'power' => 'numeric',
                    'max_speed' => 'numeric',
                    'min_mass' => 'numeric',
                    'max_mass' => 'numeric',
                    'trailer_mass' => 'numeric',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'  => 'required',
                    'id_model' => 'required|numeric',
                    'length' => 'numeric',
                    'width' => 'numeric',
                    'height' => 'numeric',
                    'trunk_volume_min' => 'numeric',
                    'trunk_volume_max' => 'numeric',
                    'tank_volume' => 'numeric',
                    'engine_displacement' => 'numeric',
                    'engine_displacement_working_value' => 'numeric',
                    'gears' => 'numeric',
                    'power' => 'numeric',
                    'max_speed' => 'numeric',
                    'min_mass' => 'numeric',
                    'max_mass' => 'numeric',
                    'trailer_mass' => 'numeric',
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
