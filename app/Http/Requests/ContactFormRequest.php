<?php

namespace App\Http\Requests;

use App\Models\Inquiry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactFormRequest extends FormRequest
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
       return Inquiry::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'You must verify google recaptcha.',
        ];
    }
}
