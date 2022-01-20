<?php

namespace App\Http\Requests;

use App\Models\JobShift;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobShiftRequest extends FormRequest
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
        $jobShift = $this->route('jobShift');
        $rules = JobShift::$rules;
        $rules['shift'] = 'required|max:160|unique:job_shifts,shift,'.$jobShift->id;

        return $rules;
    }
}
