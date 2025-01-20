<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\SalePost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SalePostController extends Controller
{
    
    /**
     * Display a listing of the pending sale posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        
        $salePosts = SalePost::orderBy('created_at', 'desc')->pending()->get();
        
        return response()->json($salePosts);
    }

    /**
     * Retrieve and stream an image from the storage disk.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getImage(Request $request) {
        $filepath = $request->filepath;

        if (!Storage::disk('public')->exists($filepath)) {
            return response()->json(['error' => 'Image not found'], 404);
        }
    
        $absolutePath = storage_path('app/public/' . $filepath);

        $mimeType = mime_content_type($absolutePath);

        $fileSize = filesize($absolutePath);

        return response()->stream(function () use ($absolutePath) {
            readfile($absolutePath);
        }, 200, [
            "Content-Type" => $mimeType,
            "Content-Length" => $fileSize,
            "Content-Disposition" => "inline; filename=\"" . basename($filepath) . "\""
        ]);
    }
}
