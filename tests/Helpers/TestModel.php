<?php

namespace HuubVerbeek\ModelAttributesValidation\Tests\Helpers;

use HuubVerbeek\ModelAttributesValidation\Attributes\ValidationRules;
use Illuminate\Database\Eloquent\Model;

#[ValidationRules(TestModelRules::class)]
class TestModel extends Model
{
    protected $guarded = [];

    public function isSaving(): void
    {
        $this->fireModelEvent('saving', false);
    }
}
