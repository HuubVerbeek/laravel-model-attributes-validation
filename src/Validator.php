<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation;

use HuubVerbeek\ModelAttributesValidation\Attributes\ValidationRules as RulesAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator as IlluminateValidator;
use Illuminate\Validation\ValidationException;
use ReflectionAttribute;
use ReflectionClass;

class Validator
{
    public function __construct(protected Model $model) {}

    public static function make(Model $model): static
    {
        return new static($model);
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        if (! $rules = $this->getRules()) {
            return;
        }

        IlluminateValidator::make(
            $this->model->attributesToArray(),
            $rules->rules(),
        )->validate();
    }

    private function getRules(): ?ValidationRules
    {
        if (! $attribute = $this->getAttribute()) {
            return null;
        }

        if (! $rulesClass = $this->getRulesClass($attribute)) {
            return null;
        }

        return new $rulesClass($this->model);
    }

    private function getAttribute(): ?ReflectionAttribute
    {
        return (new ReflectionClass($this->model))->getAttributes(RulesAttribute::class)[0] ?? null;
    }

    private function getRulesClass(ReflectionAttribute $attribute): ?string
    {
        return $attribute->newInstance()->rulesClass ?? null;
    }
}
