<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Cart;
use App\Policies\CartPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Cart::class => CartPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
