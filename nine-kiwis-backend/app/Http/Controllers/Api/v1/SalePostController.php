<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\SalePost;
use Illuminate\Http\Request;

class SalePostController extends Controller
{
    public function index() {
        $salePosts = SalePost::pending()->get();
        return response()->json($salePosts);
    }
}
