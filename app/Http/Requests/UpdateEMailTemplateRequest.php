<?php

namespace App\Http\Requests;

use App\Models\EmailTemplate;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateEMailTemplateRequest
 */
class UpdateEMailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return EmailTemplate::$rules;
    }
}
