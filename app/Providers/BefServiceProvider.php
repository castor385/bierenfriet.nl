<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Auth\BefUserProvider;
use App\Library\Auth\BefAuthManager;
use Auth;
use App;

class BefServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('bef', function ($app) {
            // enforce binding of extended Guard Interface with the new driver
            // $abstract = 'App\Library\Auth\BefAuthInterface';
            // $this->app->bind($abstract, 'auth.driver');
            // $this->app->bind("auth", function ($app) {
            //     $app['auth.loaded'] = true;
            //     return new BefAuthManager($app);
            // });
            // $this->app->singleton('auth.driver', function ($app) {
            //     return $app['auth']->driver();
            // });

            $model = $this->app['config']['auth.model'];
            return new BefUserProvider(
                App::make('App\Library\Hashing\BefMd5Hasher'),
                $model
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('auth', function ($app) {
            // Once the authentication service has actually been requested by the developer
            // we will set a variable in the application indicating such. This helps us
            // know that we need to set any queued cookies in the after event later.
            $app['auth.loaded'] = true;

            return new BefAuthManager($app);
        });

        $this->app->singleton('auth.driver', function ($app) {
            return $app['auth']->driver();
        });
    }
}
