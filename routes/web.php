<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// routes task_statutse with auth middleware
Route::resource('task_statuses', TaskStatusController::class)
    ->only(['index']);

Route::middleware('auth')->group(function () {
    Route::resource('task_statuses', TaskStatusController::class)
        ->except(['index', 'show']);
});

// routes tasks
Route::resource('tasks', TaskController::class);

// routes labels
Route::resource('labels', LabelController::class);

// отправка тестого письма, потом удалить
Route::get('/send-test-mail', function () {
    Mail::to('any@example.com')->send(new TestMail());
    return 'Письмо отправлено, смотри storage/logs/laravel.log';
});

require __DIR__.'/auth.php';
