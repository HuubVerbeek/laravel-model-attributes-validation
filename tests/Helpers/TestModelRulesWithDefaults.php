<?php

namespace HuubVerbeek\ModelAttributesValidation\Tests\Helpers;

use HuubVerbeek\ModelAttributesValidation\Contracts\WithDefaults;
use HuubVerbeek\ModelAttributesValidation\ValidationRules;

class TestModelRulesWithDefaults extends ValidationRules implements WithDefaults
{
    public function rules(): array
    {
        return [
            'property' => ['required'],
            'default' => ['required'],
        ];
    }

    public function defaults(): array
    {
        return [
            'default' => 'default',
        ];
    }
}
