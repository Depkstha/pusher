<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\AllNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendReminderNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            $data = [
                'user_id' => $user->id,
                'title' => "Notification for {$user->name}",
                'content' => "Hello I am Deepak Shrestha. How are you?",
            ];

            Notification::send($user, new AllNotification(fluent($data)));
        }

        Log::info("Notification sent");
    }
}
