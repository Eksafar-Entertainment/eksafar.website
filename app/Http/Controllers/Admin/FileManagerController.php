<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileManagerController extends Controller
{
    public function index()
    {
        return view("admin.file-manager.index");
    }

    public function listing(Request $request)
    {
        $dir = $request->dir;
        $disk = Storage::disk('public');
        $path = $disk->getAdapter()->getPathPrefix();
        $files = $disk->files($dir);
        $directories = $disk->directories($dir);
        $icon = File::get(public_path("images/file-type-icons/file.svg"));

        $results = [];
        foreach ($files as $file) {
            if (substr($file, 0, 1) === ".") {
                continue;
            }
            if (substr(File::mimeType($path . $file), 0, 5) == 'image') {
                $icon_url = url("storage/" . $file);
            } else {
                $icon = str_replace("{{type}}", strtoupper(File::extension($path . $file)), $icon);
                $icon_path = public_path("images/file-type-icons/file-" . File::extension($path . $file) . ".svg");
                if (!File::exists($icon_path)) {
                    File::put($icon_path, $icon);
                }
                $icon_url = url("images/file-type-icons/file-" . File::extension($path . $file) . ".svg");
            }
            $results[] = [
                "name" => File::basename($path . $file),
                "size" => File::size($path . $file),
                "type" => File::type($path . $file),
                "mim-type" => File::mimeType($path . $file),
                "icon" => $icon_url
            ];
        }
        foreach ($directories as $file) {
            $icon_url = url("images/file-type-icons/folder.png");
            $results[] = [
                "name" => File::basename($path . $file),
                "size" => File::size($path . $file),
                "type" => File::type($path . $file),
                "mim-type" => File::mimeType($path . $file),
                "icon" => $icon_url
            ];
        }
        return response()->json([
            "status" => 200,
            'message' => 'Successfully fetched data',
            "html" => view("admin.file-manager.listing", [
                "disk" => $disk,
                "prefix" => $dir,
                "results" => $results,
            ])->render()
        ]);
    }
}
