<?php

use App\Http\Controllers\Api\v1\SalePostController;
use Illuminate\Support\Facades\Route;

Route::get('/sale-posts', [SalePostController::class, 'index'])->name('retrieve-sale-posts');
Route::get('/get-image', [SalePostController::class, 'getImage'])->name('stream-image-by-path');
