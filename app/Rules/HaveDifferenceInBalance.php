<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HaveDifferenceInBalance implements Rule
{
    private $visit;
    private $client;

    /**
     * Create a new rule instance.
     *
     * @param $visit
     * @param $client
     */
    public function __construct($visit, $client)
    {
        $this->visit = $visit;
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
        $difference =  $value - $this->visit->value_visit;
        return $this->client->balance_quota >= $difference;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No tienes cupo disponible para hacer este cambio.';
    }
}
