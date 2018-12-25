<?php

namespace App\Http\Requests\Clients;

use App\Http\Requests\Request as FormRequest;
use App\Rules\IsMinor;

class StoreRequest extends FormRequest
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
            'nit' => 'required',
            'name' => 'string|required',
            'direction' => 'string|required',
            'telephone' => 'numeric|required',
            'city_id' => 'exists:cities,id',
            'quota' => 'numeric|min:0|required',
            'balance_quota' => ['numeric', 'min:0', new IsMinor($this->get('quota'))],
            'percentage_visits' => 'numeric|min:1|max:100'
        ];
    }
}
