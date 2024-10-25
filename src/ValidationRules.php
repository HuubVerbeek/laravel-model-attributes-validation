<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation;

use Illuminate\Database\Eloquent\Model;

abstract class ValidationRules
{
    public function __construct(protected Model $model)
    {
        //
    }

    abstract public function rules(): array;
}
