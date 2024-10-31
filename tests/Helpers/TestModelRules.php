<?php

namespace HuubVerbeek\ModelAttributesValidation\Tests\Helpers;

use HuubVerbeek\ModelAttributesValidation\ValidationRules;

class TestModelRules extends ValidationRules
{
    public function rules(): array
    {
        return [
            'property' => ['required'],
        ];
    }
}
