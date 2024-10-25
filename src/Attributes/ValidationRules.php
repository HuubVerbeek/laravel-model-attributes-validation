<?php

namespace HuubVerbeek\ModelAttributesValidation\Attributes;

use Attribute;
use HuubVerbeek\ModelAttributesValidation\Exceptions\NotSubclassOfRulesException;
use HuubVerbeek\ModelAttributesValidation\ValidationRules as AbstractRules;

#[Attribute(Attribute::TARGET_CLASS)]
class ValidationRules
{
    /**
     * @throws NotSubclassOfRulesException
     */
    public function __construct(public string $rulesClass)
    {
        if (! is_subclass_of($rulesClass, AbstractRules::class)) {
            throw new NotSubclassOfRulesException;
        }
    }
}
