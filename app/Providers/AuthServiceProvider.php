<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\Category;
use App\Policies\TaskPolicy;
use Laravel\Passport\Passport;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
