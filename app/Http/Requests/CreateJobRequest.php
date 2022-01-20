<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $salaryFrom = removeCommaFromNumbers($this->request->get('salary_from'));
        $salaryTo = removeCommaFromNumbers($this->request->get('salary_to'));

        $this->request->set('salary_from', $salaryFrom);
        $this->request->set('salary_to', $salaryTo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Job::$rules;

        return $rules;
    }
}
