<?php namespace App\Library\Auth;

use Illuminate\Auth\AuthManager;
use App;

class BefAuthManager extends AuthManager
{
    /**
     * Call a custom driver creator.
     *
     * @param  string  $driver
     * @return \Illuminate\Auth\Guard
     */
    protected function callCustomCreator($driver)
    {
        $model = $this->app['config']['auth.model'];
        $provider = new BefUserProvider(
            App::make('App\Library\Hashing\BefMd5Hasher'),
            $model
        );
        return new BefAuthGuard($provider, $this->app['session.store']);
    }
}
