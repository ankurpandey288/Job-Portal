<?php

namespace App\Http\Requests;

use App\Models\NewsLetter;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateNewsLetterRequest
 */
class CreateNewsLetterRequest extends FormRequest
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
        return NewsLetter::$rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique'  => 'You are already subscribed.',
        ];
    }
}
