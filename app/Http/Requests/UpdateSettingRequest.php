<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateSettingRequest extends FormRequest
{
    /**
     * @throws ValidationException
     */
    public function prepareForValidation()
    {
        $companyDescription = trim(request()->get('company_description'));
        $sectionName = request()->all();
        if ($sectionName['sectionName'] == 'general') {
            if (empty($companyDescription)) {
                throw ValidationException::withMessages([
                    'company_description' => 'Company Description is required',
                ]);
            }
            if (empty(request()->get('company_url'))) {
                throw ValidationException::withMessages([
                    'company_url' => 'Company URL is required',
                ]);
            }
        } else {
            if ($sectionName['sectionName'] == 'front_office_details') {
                if (empty(trim(request()->get('address')))) {
                    throw ValidationException::withMessages([
                        'address' => 'Address is required',
                    ]);
                }
            } else {
                if ($sectionName['sectionName'] == 'about_us') {
                    if (empty((request()->get('about_us')))) {
                        throw ValidationException::withMessages([
                            'company_description' => 'About Us is required',
                        ]);
                    }
                }
            }
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
        return [
            'application_name' => 'required_with:company_description',
        ];
    }
}
