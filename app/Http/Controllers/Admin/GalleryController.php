<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery_images = GalleryImage::latest()->paginate(20);

        return view('admin.gallery.index', compact('gallery_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery_image = new GalleryImage();
        $gallery_image->title= $request->title;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . Str::slug($file->getClientOriginalName());
            $file->move(public_path('storage/uploads'), $filename);
            $gallery_image->path = $filename;
        }

        $gallery_image->save();

        return redirect()->route('gallery.index')
            ->withSuccess(__('Gallery image created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    $gallery_image = GalleryImage::find($id)->first();
        return view('admin.gallery.show', [
            'gallery_image' => $gallery_image
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        GalleryImage::destroy($id);

        return redirect()->route('gallery.index')
            ->withSuccess(__('GalleryImage deleted successfully.'));
    }

}
