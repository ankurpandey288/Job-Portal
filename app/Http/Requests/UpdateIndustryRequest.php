<?php

namespace App\Http\Requests;

use App\Models\Industry;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIndustryRequest extends FormRequest
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
        $industry = $this->route('industry');
        $rules = Industry::$rules;
        $rules['name'] = 'required|max:150|unique:industries,name,'.$industry->id;

        return $rules;
    }
}
