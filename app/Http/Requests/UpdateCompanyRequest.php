<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * @throws ValidationException
     */
    public function prepareForValidation()
    {
        $employerDetails = trim(request()->get('details'));
        if (empty($employerDetails)) {
            throw ValidationException::withMessages([
                'details' => 'Employer Details is required',
            ]);
        }
    }

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
        $rules = Company::$rules;
        $rules['name'] = 'required|max:180';
        $rules['email'] = 'required|email:filter|unique:users,email,'.$this->input('user_id');
        $rules['password'] = 'nullable|same:password_confirmation|min:6';
        $rules['phone'] = 'nullable';

        return $rules;
    }
}
