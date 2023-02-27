<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCouponRequest  $request
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
        Coupon::create(array_merge($request->only(
            'type',
            'code',
            'discount',
            'remaining_count',
        )));

        return redirect()->route('coupon.index')
            ->withSuccess(__('Coupon created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupon.show', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->only(
            'type',
            'code',
            'discount',
            'remaining_count',
        ));

        return redirect()->route('coupon.index')
            ->withSuccess(__('Coupon updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupon.index')
            ->withSuccess(__('Coupon deleted successfully.'));
    }
}
