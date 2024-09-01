<?php

use Illuminate\Support\Facades\Route;

Route::get('/expired-subscriptions-count', [AdminController::class, 'getExpiredSubscriptionsCount']);

