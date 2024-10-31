<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation\Tests\Unit;

use HuubVerbeek\ModelAttributesValidation\Tests\Helpers\TestModel;
use HuubVerbeek\ModelAttributesValidation\Tests\Helpers\TestModelWithDefaults;
use HuubVerbeek\ModelAttributesValidation\Tests\TestCase;
use Illuminate\Validation\ValidationException;

class ValidatorTest extends TestCase
{
    public function test_listener_validates_model_attributes()
    {
        TestModel::make(['property' => 'value'])->isSaving();

        $this->expectException(ValidationException::class);

        TestModelWithDefaults::make()->isSaving();
    }

    public function test_listener_sets_default_model_attributes()
    {
        $model = TestModelWithDefaults::make(['property' => 'value']);

        $model->isSaving();

        $this->assertEquals('default', $model->default);
    }
}
