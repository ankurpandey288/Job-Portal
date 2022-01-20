<?php

namespace App\Http\Requests;

use App\Models\CandidateExperience;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCandidateExperienceRequest
 */
class CreateCandidateExperienceRequest extends FormRequest
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
        return CandidateExperience::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'country_id.required' => 'The country field is required.',
        ];
    }
}
