<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation\Tests;

use HuubVerbeek\ModelAttributesValidation\ModelAttributesValidationServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            ModelAttributesValidationServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
