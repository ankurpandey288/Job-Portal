<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateOnlineProfileRequest extends FormRequest
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
        return [
            'facebook_url'    => 'nullable|url',
            'twitter_url'     => 'nullable|url',
            'linkedin_url'    => 'nullable|url',
            'google_plus_url' => 'nullable|url',
            'pinterest_url'   => 'nullable|url',
        ];
    }
}
