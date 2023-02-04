<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venue;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::latest()->paginate(10);

        return view('admin.venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo = "";
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = date('YmdHi') . '.'.$file->extension();
            $file->move(public_path('storage/uploads'), $filename);
            $logo = $filename;
        }

        $cover = "";
        if ($request->file('cover')) {
            $file = $request->file('cover');
            $filename = date('YmdHi') . '.'.$file->extension();
            $file->move(public_path('storage/uploads'), $filename);
            $cover = $filename;
        }
        Venue::create(array_merge($request->only(
            'name', 
            'mobile', 
            'email', 
            'excerpt', 
            'description', 
            'location', 
            'address', 
            'founded_at', 
            'tags', 
            'logo',
            'cover',
            "map_url"
        )));

        return redirect()->route('venue.index')
            ->withSuccess(__('Venue created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return view('admin.venue.show', [
            'venue' => $venue
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return view('admin.venue.edit', [
            'venue' => $venue
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $venue->update($request->only(
            'name', 
            'mobile', 
            'email', 
            'excerpt', 
            'description', 
            'location', 
            'address', 
            'founded_at', 
            'tags', 
            'logo',
            'cover',
            "map_url"
        ));

        return redirect()->route('venue.index')
            ->withSuccess(__('Venue updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('venue.index')
            ->withSuccess(__('Venue deleted successfully.'));
    }

}
