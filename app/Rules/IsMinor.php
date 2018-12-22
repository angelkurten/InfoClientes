<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsMinor implements Rule
{
    private $quota;

    /**
     * Create a new rule instance.
     *
     * @param $quota
     */
    public function __construct($quota)
    {
        //
        $this->quota = $quota;
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
        return $this->quota >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El saldo cupo no debe ser mayor al cupo';
    }
}
