<?php

namespace App\Providers;

use App\Models\User;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['request']->server->set('HTTPS', env('USE_HTTPS') != false);

        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });

        Gate::before(function (User $user, string $permission) {
            if ($user->roles->map(function ($r) {
                return $r->name;
            })->contains('Admin')) {
                return true;
            }

            $permissions = collect([]);

            foreach ($user->roles as $role) {
                foreach ($role->permissions as $permissionObj) {
                    $permissions->push($permissionObj->name);
                }
            }

            if ($permissions->contains($permission)) {
                return true;
            }



            return false;
        });
    }
}
