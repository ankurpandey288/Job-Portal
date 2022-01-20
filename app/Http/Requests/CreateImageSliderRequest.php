<?php

namespace App\Http\Requests;

use App\Models\ImageSlider;
use Illuminate\Foundation\Http\FormRequest;

class CreateImageSliderRequest extends FormRequest
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
        return ImageSlider::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'image_slider.required' => 'The image field is required.',
        ];
    }
}
