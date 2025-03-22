<?php

use App\Http\Controllers\SendFeedbackController;
use Illuminate\Support\Facades\Route;

Route::post('/send', [SendFeedbackController::class, 'sendFeedback'])->name('feedback.form');
