<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreArtistRequest;
// use App\Http\Requests\UpdateArtistRequest;
use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::latest()->paginate(20);
        return view('admin.artist.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArtistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = "";
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . '.' . $file->extension();
            $file->move(public_path('storage/uploads'), $filename);
            $image = $filename;
        }

        $cover = "";
        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filename = date('YmdHi') . '.' . $file->extension();
            $file->move(public_path('storage/uploads'), $filename);
            $cover = $filename;
        }
        Artist::create(array_merge($request->only(
            'name',
            'image',
            'email',
            'phone',
            'excerpt',
            'description',
            'tags',
            'cover',
        )));

        return redirect()->route('artist.index')
            ->withSuccess(__('Artist created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return view('admin.artist.show', [
            'artist' => $artist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        return view('admin.artist.edit', [
            'artist' => $artist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArtistRequest  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $artist->update($request->only(
            'name',
            'image',
            'email',
            'phone',
            'excerpt',
            'description',
            'tags',
            'cover',
        ));

        return redirect()->route('artist.index')
            ->withSuccess(__('Artist updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artist.index')
            ->withSuccess(__('Artist deleted successfully.'));
    }
}
