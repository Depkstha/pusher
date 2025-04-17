<?php

use App\Jobs\SendReminderNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    Log::info(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    Log::info("Logging...");
})->everyFiveSeconds();

Schedule::job(new SendReminderNotification)->everyFiveSeconds();
