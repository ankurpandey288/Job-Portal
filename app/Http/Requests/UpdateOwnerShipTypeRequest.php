<?php

namespace App\Http\Requests;

use App\Models\OwnerShipType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerShipTypeRequest extends FormRequest
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
        $rules = OwnerShipType::$rules;
        $rules['name'] = 'required|max:150|unique:ownership_types,name,'.$this->route('ownerShipType')->id;

        return $rules;
    }
}
