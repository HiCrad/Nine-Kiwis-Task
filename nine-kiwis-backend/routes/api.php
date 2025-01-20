<?php

use App\Http\Controllers\Api\v1\SalePostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/sale-posts', [SalePostController::class, 'index']);
