<?php

namespace App\Http\Controllers\Front\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ImageController extends Controller
{
    function serve(Request $request){
        $size = $request->size;
        $height = $request->height ?? null;
        $width = $request->width ?? null;
        $path = public_path($request->src);
        $image = \Intervention\Image\Facades\Image::cache(function ($image) use ($path, $height, $width) {
            return $image->make($path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }, 100, false);
        return response()->make($image, 200, array('Content-Type' => 'image/jpeg'));
    }

    function generateQrCode(Request $request){
        $content = $request->content;
        $size = $request->size ?? 200;
        $image = QrCode::format('png')->size($size)->generate($content);
        return response()->make($image, $size, array('Content-Type' => 'image/jpeg'));
    }
}
