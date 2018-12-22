<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'balance_quota' => 'numeric|min:0|required|lte:quota',
            'percentage_visits' => 'numeric|min:1|max:100'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
