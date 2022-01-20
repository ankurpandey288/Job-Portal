<?php

namespace App\Http\Requests;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerProfileRequest extends FormRequest
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
     * @return array The given data was invalid.
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required|max:180',
            'phone'      => 'nullable|min:10|max:10',
        ];

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = User::$messages;
        if (Auth::user()->hasRole('Employer')) {
            $messages['first_name.required'] = 'The Employer Name is required.';
        }

        return $messages;
    }
}
