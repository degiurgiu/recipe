<?php

namespace App\Providers;

use App\Console\Commands\Email\SendEmails;
use App\Events\PodcastProcessed;
use App\Listeners\SendPodcastNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendEmails::class => [
            SendPodcastNotification::class,
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Model Observers with audits
        User::observe(UserObserver::class);
    }
}
