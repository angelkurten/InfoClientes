<?php

namespace App\Http\Requests\Visit;

use App\Client;
use App\Http\Requests\Request as FormRequest;
use App\Rules\HaveBalance;

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
        $client = Client::find($this->get('client_id'));
        return [
            'visit_at' => 'required|date',
            'client_id' => 'exists:clients,id',
            'seller_id' => 'exists:sellers,id',
            'value_net' => 'numeric|required',
            'value_visit' => ['numeric', 'required', new HaveBalance($client)],
            'observations' => 'alpha_dash',
        ];
    }
}
