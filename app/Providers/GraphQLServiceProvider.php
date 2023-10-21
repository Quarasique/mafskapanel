<?php

namespace App\Providers;

use App\GraphQL\TypeRegister;
use Illuminate\Support\ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    public function boot(TypeRegister $typeRegister): void
    {
        $typeRegister->register();
    }
}
