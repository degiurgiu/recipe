<?php

namespace App\Observers;

use App\Events\PodcastProcessed;
use App\Mail\SendWelcomeNewUserEmail;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $characters = 'ab@CdefGhijklMno#p!qrsTuvwXyz0123456789';
        $random_string_length = rand(5, 9);
        $tmp_password = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $random_string_length; $i++) {
            $tmp_password .= $characters[mt_rand(0, $max)];
        }

//       $temp_pass = Hash::make($tmp_password);

        $temp_pass = Hash::make('password', [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);

        $data = [
            'tmp_password' => $temp_pass,
            'user' => $user
        ];
        Mail::to($user['email'])->send(new SendWelcomeNewUserEmail($data));

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {

        $message = 'user observer.'.$user['name'];
        Log::emergency($message);
        Log::alert($message);
        Log::critical($message);
        Log::error($message);
        Log::warning($message);
        Log::notice($message);
        Log::info($message);
        Log::debug($message);
         return;
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
