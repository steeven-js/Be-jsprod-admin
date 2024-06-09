<?php

use App\Mail\ContactMail;
use App\Mail\OrderShipped;
use App\Models\Shop\Service;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\api\StripeController;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/test', function () {
    $services = Service::with('media')->get();

    dd($services);
});

Route::get('/success/{CHECKOUT_SESSION_ID}', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/cancel/{CHECKOUT_SESSION_ID}', [StripeController::class, 'cancel'])->name('checkout.cancel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
