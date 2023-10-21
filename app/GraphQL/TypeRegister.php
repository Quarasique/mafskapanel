<?php

namespace App\GraphQL;

use App\Enums\Alignment;
use App\Enums\Time;
use GraphQL\Type\Definition\PhpEnumType;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class TypeRegister
{
    public function __construct(
        private TypeRegistry $typeRegistry
    ) {
    }

    public function register(): void
    {
        $this->typeRegistry->register(
            new PhpEnumType(Alignment::class),
        );

        $this->typeRegistry->register(
            new PhpEnumType(Time::class),
        );
    }
}
