<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation;

use HuubVerbeek\ModelAttributesValidation\Attributes\ValidationRules as RulesAttribute;
use HuubVerbeek\ModelAttributesValidation\Contracts\WithDefaults;
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
            ...$this->prepare($this->model, $rules)
        )->validate();
    }

    private function prepare(Model $model, ValidationRules $rules): array
    {
        if (! $model->exists) {
            return $this->isCreating($model, $rules);
        }

        return $this->isUpdating($model, $rules);
    }

    private function isCreating(Model $model, ValidationRules $rules): array
    {
        return $rules instanceof WithDefaults
            ? $this->withDefaults($model, $rules)
            : [$model->attributesToArray(), $rules->rules()];
    }

    private function isUpdating(Model $model, ValidationRules $rules): array
    {
        return [
            $model->attributesToArray(),
            array_intersect_key($rules->rules(), $model->attributesToArray()),
        ];
    }

    private function withDefaults(Model $model, ValidationRules $rules): array
    {
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $defaults = array_diff_key(
            $rules->defaults(),
            $model->attributesToArray()
        );

        return [
            $model->fill($defaults)->attributesToArray(),
            $rules->rules(),
        ];
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
