<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $amount = $this->request->get('amount');
        $this->request->set('amount', removeCommaFromNumbers($amount));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $plan = $this->route('plan');
        $rules = Plan::$rules;
        $rules['name'] = 'required|max:180|unique:plans,name,'.$plan->id;
        $rules['amount'] = 'sometimes';

        return $rules;
    }
}
