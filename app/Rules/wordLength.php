<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class wordLength implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (str_word_count($value) <=50)   return true;
        else                                return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Поле :attribute должно иметь не более чем 100.';
    }
}
