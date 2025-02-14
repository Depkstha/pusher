<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Notifications\AllNotification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/broadcast', function () {

    $users = User::whereId(auth()->id())->get();

    foreach ($users as $user) {
        $data = [
            'user_id' => $user->id,
            'title' => "Notification for {$user->name}",
            'content' => "Hello I am Deepak Shrestha. How are you?",
        ];

        Notification::send($user, new AllNotification(fluent($data)));
    }

    echo "Notification sent";
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
