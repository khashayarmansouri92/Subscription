<?php

use App\Http\Controllers\User\Auth\LoginAction;
use Illuminate\Support\Facades\Route;


Route::post('login', LoginAction::class);
