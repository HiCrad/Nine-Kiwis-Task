<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\SalePost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SalePostController extends Controller
{
    public function index() {
        
        $salePosts = SalePost::pending()->get();
        
        return response()->json($salePosts);
    }
}
