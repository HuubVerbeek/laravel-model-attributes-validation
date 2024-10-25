<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ModelAttributesValidationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Event::listen(['eloquent.saving: *'], function (string $event, array $data): void {
            /** @var Model $model */
            $model = $data[0];

            Validator::make($model)->validate();
        });
    }
}
