<?php

namespace App\Http\Requests;

use App\Models\JobApplication;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApplyJobRequest
 */
class ApplyJobRequest extends FormRequest
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
        $expectedSalary = removeCommaFromNumbers($this->request->get('expected_salary'));

        $this->request->set('expected_salary', $expectedSalary);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobApplication::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'resume_id.required' => 'The Resume Field is Required.',
        ];
    }
}
