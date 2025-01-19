<?php

use App\Livewire\CreateSalePost;
use App\Livewire\SalePostList;
use Illuminate\Support\Facades\Route;

Route::get('/', SalePostList::class)->name('sale-posts.index');

Route::get('/create-sale-post', CreateSalePost::class)->name('sale-posts.create');