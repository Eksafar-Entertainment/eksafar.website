<?php

namespace App\Http\Controllers\Front\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Templates\Large;

class ImageController extends Controller
{
    protected $sizes = [
        "sm" => [120, 90],
        "md" => [240, 180],
        "lg" => [480, 360],
        "xl" => [960, 720],
        "xxl" => [1080, 810],
    ];
    function serve(Request $request)
    {
        $size = $request->size;
        $height = $request->height ?? null;
        $width = $request->width ?? null;
        $path = public_path($request->src);
        $image = \Intervention\Image\Facades\Image::cache(function ($image) use ($path, $height, $width, $size) {
            if ($size) {
                return $image->make($path)->resize($this->sizes[$size][0], $this->sizes[$size][1], function ($constraint) {
                    $constraint->upsize();
                });
            } else {
                return $image->make($path)->fit($width, $height);
            }
        }, 100, false);
        return response()->make($image, 200, array('Content-Type' => 'image/jpeg'));
    }

    function generateQrCode(Request $request)
    {
        $content = $request->content;
        $size = $request->size ?? 200;
        $image = QrCode::format('png')->size($size)->generate($content);
        return response()->make($image, $size, array('Content-Type' => 'image/jpeg'));
    }
}
