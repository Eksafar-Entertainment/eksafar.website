<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = Banner::create($request->only(
            'title',
            'position',
            'image',
            'description',
            'url'
        ));


        return redirect()->route('banner.index')
            ->withSuccess(__('Banner image created successfully.'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->update($request->only(
            'title',
            'position',
            'image',
            'description',
            'url'
        ));

        return redirect()->route('banner.index')
            ->withSuccess(__('Banner updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);

        return redirect()->route('banner.index')
            ->withSuccess(__('Banner deleted successfully.'));
    }
}
