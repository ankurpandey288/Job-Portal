<?php

namespace App\Http\Requests;

use App\Models\HeaderSlider;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateHeaderSliderRequest
 */
class CreateHeaderSliderRequest extends FormRequest
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
        return HeaderSlider::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'header_slider.required' => 'The image field is required.',
        ];
    }
}
