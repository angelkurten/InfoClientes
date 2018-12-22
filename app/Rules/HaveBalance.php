<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HaveBalance implements Rule
{
    private $client;

    /**
     * Create a new rule instance.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->client->balance_quota >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No tiene cupo disponible para esta visita.';
    }
}
