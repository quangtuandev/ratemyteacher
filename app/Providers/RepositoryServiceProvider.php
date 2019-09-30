<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    protected static $repositories = [
        'user' => [
            \App\Repositories\Contracts\UserInterface::class,
            \App\Repositories\Eloquent\UserRepository::class,
        ],
        'role' => [
            \App\Repositories\Contracts\RoleInterface::class,
            \App\Repositories\Eloquent\RoleRepository::class,
        ],
        'social_account' => [
            \App\Repositories\Contracts\SocialAccountInterface::class,
            \App\Repositories\Eloquent\SocialAccountRepository::class,
        ],
        'teacher' => [
            \App\Repositories\Contracts\TeacherInterface::class,
            \App\Repositories\Eloquent\TeacherRepository::class,
        ],
        'review' => [
            \App\Repositories\Contracts\ReviewTeacherInterface::class,
            \App\Repositories\Eloquent\ReviewTeacherRepository::class,
        ],
        'center' => [
            \App\Repositories\Contracts\CenterInterface::class,
            \App\Repositories\Eloquent\CenterRepository::class,
        ],
    ];
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1]
            );
        }
    }
}
