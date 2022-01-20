<?php

namespace App\Http\Requests;

use App\Models\SalaryPeriod;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSalaryPeriodRequest extends FormRequest
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
        $salaryPeriod = $this->route('salaryPeriod');
        $rules = SalaryPeriod::$rules;
        $rules['period'] = 'required|max:150|unique:salary_periods,period,'.$salaryPeriod->id;

        return $rules;
    }
}
