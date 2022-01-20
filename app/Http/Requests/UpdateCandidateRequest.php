<?php

namespace App\Http\Requests;

use App\Models\Candidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
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
        $currentSalary = removeCommaFromNumbers($this->request->get('current_salary'));
        $expectedSalary = removeCommaFromNumbers($this->request->get('expected_salary'));

        $this->request->set('current_salary', $currentSalary);
        $this->request->set('expected_salary', $expectedSalary);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Candidate::$rules;
        $rules['email'] = 'required|email:filter|unique:users,email,'.$this->route('candidate')->user->id;

        return $rules;
    }
}
