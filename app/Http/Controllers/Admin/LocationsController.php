<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $locations = Location::select(["*"]);
        if(isset($request->query()["keyword"]) && $request->query()["keyword"]!=""){
            $locations->where(function ($query) {
                global $request;
                $query->orWhere("locations.name","like", "%{$request->query()["keyword"]}%");
            });
        }
        $locations = $locations->latest()->paginate(10)->appends($request->query());

        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Location::create(array_merge($request->only('name', 'country'),[
            'user_id' => auth()->id()
        ]));

        return redirect()->route('locations.index')
            ->withSuccess(__('Location created successfully.'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('admin.locations.edit', [
            'location' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $location->update($request->only('name', 'country'));

        return redirect()->route('locations.index')
            ->withSuccess(__('Location updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
            ->withSuccess(__('Location deleted successfully.'));
    }

}
