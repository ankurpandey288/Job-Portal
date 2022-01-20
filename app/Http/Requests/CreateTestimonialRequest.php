<?php

namespace App\Http\Requests;

use App\Models\Testimonial;
use Illuminate\Foundation\Http\FormRequest;

class CreateTestimonialRequest extends FormRequest
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
        return Testimonial::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'branding_slider.required' => 'The image field is required.',
        ];
    }
}
