<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
        $rules['name'] = 'required|max:180|unique:countries,name,'.$this->route('country')->id;
        $rules['short_code'] = 'required|unique:countries,short_code,'.$this->route('country')->id;
        $rules['phone_code'] = 'nullable|unique:countries,phone_code,'.$this->route('country')->id;

        return $rules;
    }
}
