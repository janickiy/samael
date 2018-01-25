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
                    'model' => 'required|numeric',
                    'length' => 'required|numeric',
                    'width' => 'required|numeric',
                    'height' => 'required|numeric',
                    'wheel_base' => 'required',
                    'front_rut' => 'required',
                    'back_rut' => 'required',
                    'front_overhang' => 'required',
                    'back_overhang' => 'required',
                    'trunk_volume_min' => 'required',
                    'trunk_volume_max' => 'required',
                    'tank_volume' => 'required',
                    'engine_displacement' => 'required',
                    'engine_displacement_working_value' => 'required',
                    'gears' => 'required',
                    'power' => 'required',
                    'max_speed' => 'required',
                    'clearance' => 'required',
                    'min_mass' => 'required',
                    'max_mass' => 'required',
                    'trailer_mass' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'  => 'required',
                    'model' => 'required|numeric',
                    'length' => 'required|numeric',
                    'width' => 'required|numeric',
                    'height' => 'required|numeric',
                    'wheel_base' => 'required',
                    'front_rut' => 'required',
                    'back_rut' => 'required',
                    'front_overhang' => 'required',
                    'back_overhang' => 'required',
                    'trunk_volume_min' => 'required',
                    'trunk_volume_max' => 'required',
                    'tank_volume' => 'required',
                    'engine_displacement' => 'required',
                    'engine_displacement_working_value' => 'required',
                    'gears' => 'required',
                    'power' => 'required',
                    'max_speed' => 'required',
                    'clearance' => 'required',
                    'min_mass' => 'required',
                    'max_mass' => 'required',
                    'trailer_mass' => 'required',
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
