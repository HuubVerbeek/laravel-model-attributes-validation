<?php

namespace HuubVerbeek\ModelAttributesValidation\Tests\Helpers;

use HuubVerbeek\ModelAttributesValidation\ValidationRules;

class TestModelValidationRules extends ValidationRules
{
    public function rules(): array
    {
        return [
            'test' => ['required'],
        ];
    }
}
