<?php

use App\Events\ToolboxUserProfileUpdated;
use App\Gateways\SubscriberUserGateway;
use App\Gateways\SubscriptionGateway;
use App\Models\Provider\Provider;
use App\Scopes\ProviderScope;
use App\Scopes\SubscriberScope;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\Links\IncomingLinks;
use \Illuminate\Support\Facades\Auth as Auth;
use \Illuminate\Support\Facades\Route as Route;


    /** Test 2
     * @return mixed|null
     */
    if (! function_exists('is_production')) {
        function is_production($service=null)
        {
            //null = 'production'
            //any = any production service
            //web = production-web
            //mobile = production-mobile
            //api = production-api
            //analytics = production-analytics

            if(stripos(app()->environment(),'production') !== false){

                //we are in production here
                if(!is_null($service)) {

                    //any product service return true
                    if($service == 'any')
                        return true;

                    //find a specific production service match
                    if (stripos(app()->environment(), $service) !== false)
                        return true;

                    //didn't find a specific service in prd --> false
                    return false;
                }

                //not looking for specific prd service
                return true;
            }

            //mot in prd
            return false;
        }
    }

if (! function_exists('enviroments')) {
    function enviroments(): bool|string
    {
        return app()->environment();
    }
}
    /**
     * Replaces toolbox() helper function to get the active guard dynamically  - kyle 6/24
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    if (! function_exists('current_session')) {
        function current_session($guard = null)
        {
            if (is_null($guard))
                return app(AuthFactory::class)->guard(activeGuard());

            return app(AuthFactory::class)->guard($guard);
        }
    }

    /**
     * @return mixed|null
     */
    if (! function_exists('activeGuard')) {
        function activeGuard()
        {
            foreach (array_keys(config('auth.guards')) as $guard) {

                if($guard == 'tpspassport')
                    continue;

                if (Auth::guard($guard)->check()) return $guard;
            }

            return null;
        }
    }


