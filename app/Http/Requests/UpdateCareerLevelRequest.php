<?php

namespace App\Http\Requests;

use App\Models\CareerLevel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerLevelRequest extends FormRequest
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
        $rules = CareerLevel::$rules;
        $rules['level_name'] = 'required|max:150|unique:career_levels,level_name,'.$this->route('careerLevel')->id;

        return $rules;
    }
}
