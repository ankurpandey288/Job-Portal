<?php

namespace App\Http\Requests;

use App\Models\JobStage;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateJobStageRequest
 */
class CreateJobStageRequest extends FormRequest
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
        return JobStage::$rules;
    }
}
