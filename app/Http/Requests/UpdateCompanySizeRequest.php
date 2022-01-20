<?php

namespace App\Http\Requests;

use App\Models\CompanySize;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySizeRequest extends FormRequest
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
        $companySize = $this->route('companySize');
        $rules = CompanySize::$rules;
        $rules['size'] = 'required|unique:company_sizes,size,'.$companySize->id;

        return $rules;
    }
}
