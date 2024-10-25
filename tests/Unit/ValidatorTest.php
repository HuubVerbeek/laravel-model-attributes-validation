<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation\Tests\Unit;

use HuubVerbeek\ModelAttributesValidation\Tests\Helpers\TestModel;
use HuubVerbeek\ModelAttributesValidation\Tests\TestCase;
use Illuminate\Validation\ValidationException;

class ValidatorTest extends TestCase
{
    public function test_listener_validates_model_attributes()
    {
        TestModel::make(['test' => 'test'])->isSaving();

        $this->expectException(ValidationException::class);

        TestModel::make()->isSaving();
    }
}
