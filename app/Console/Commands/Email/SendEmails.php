<?php

namespace App\Console\Commands\Email;

use App\Events\PodcastProcessed;
use App\Jobs\ProcessPodcast;
use App\Jobs\SendEmailCompleteEvent;
use App\Mail\Onboarding\SendManagerPendingUserEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = 'Email was sent.';
        Log::emergency($message);
        Log::alert($message);
        Log::critical($message);
        Log::error($message);
        Log::warning($message);
        Log::notice($message);
        Log::info($message);
        Log::debug($message);
        dispatch_sync((new ProcessPodcast()));
        event(new PodcastProcessed());
        Mail::to($leader)->send(new SendManagerPendingUserEmail($data));
//        ProcessPodcast::dispatchSync();
    }
}
