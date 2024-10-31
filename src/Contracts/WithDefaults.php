<?php

declare(strict_types=1);

namespace HuubVerbeek\ModelAttributesValidation\Contracts;

interface WithDefaults
{
    public function defaults(): array;
}
