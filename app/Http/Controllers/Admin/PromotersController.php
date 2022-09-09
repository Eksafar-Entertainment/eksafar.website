<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promoter;

class PromotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $promoters = Promoter::select(["*"]);
        if(isset($request->query()["keyword"]) && $request->query()["keyword"]!=""){
            $promoters->where(function ($query) {
                global $request;
                $query->orWhere("promoters.name","like", "%{$request->query()["keyword"]}%");
            });
        }
        $promoters = $promoters->latest()->paginate(10)->appends($request->query());

        return view('admin.promoters.index', compact('promoters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promoters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Promoter::create(array_merge($request->only('name', 'commission'),[
            'user_id' => auth()->id()
        ]));

        return redirect()->route('promoters.index')
            ->withSuccess(__('Promoter created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promoter  $promoter
     * @return \Illuminate\Http\Response
     */
    public function show(Promoter $promoter)
    {
        return view('admin.promoters.show', [
            'promoter' => $promoter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promoter  $promoter
     * @return \Illuminate\Http\Response
     */
    public function edit(Promoter $promoter)
    {
        return view('admin.promoters.edit', [
            'promoter' => $promoter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promoter  $promoter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promoter $promoter)
    {
        $promoter->update($request->only('name', 'commission'));

        return redirect()->route('promoters.index')
            ->withSuccess(__('Promoter updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promoter  $promoter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promoter $promoter)
    {
        $promoter->delete();

        return redirect()->route('promoters.index')
            ->withSuccess(__('Promoter deleted successfully.'));
    }

}
