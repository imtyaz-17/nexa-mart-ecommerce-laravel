<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;

class DiscountCouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = DiscountCoupon::latest('id');
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $coupons = $coupons->where('code', 'LIKE', "%{$keyword}%")
                ->orWhere('name', 'LIKE', "%{$keyword}%");
        }
        $coupons= $coupons->paginate(10);
        return view('admin.discount_coupon.list', compact('coupons'));
    }
    public function create()
    {
        return view('admin.discount_coupon.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'code' => 'required|string|unique:discount_coupons,code|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer|min:0',
            'max_uses_user' => 'nullable|integer|min:0',
            'type' => 'required|in:percent,fixed',
            'discount' => 'required|numeric|min:0',
            'min_purchased' => 'nullable|numeric|min:0',
            'status' => 'required|boolean',
            'starts_at' => 'nullable|date|before_or_equal:ends_at',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Create a new DiscountCoupon instance and fill it with validated data
        $discountCoupon = new DiscountCoupon();
        $discountCoupon->code = $validated['code'];
        $discountCoupon->name = $validated['name'] ?? null;
        $discountCoupon->description = $validated['description'] ?? null;
        $discountCoupon->max_uses = $validated['max_uses'] ?? null;
        $discountCoupon->max_uses_user = $validated['max_uses_user'] ?? null;
        $discountCoupon->type = $validated['type'];
        $discountCoupon->discount = $validated['discount'];
        $discountCoupon->min_purchased = $validated['min_purchased'] ?? 0;
        $discountCoupon->status = $validated['status'];
        $discountCoupon->starts_at = $validated['starts_at'] ?? null;
        $discountCoupon->ends_at = $validated['ends_at'] ?? null;

        // Save the discount coupon to the database
        $discountCoupon->save();

        // Redirect to the index page with a success message
        return redirect()->route('admin.coupons.index')->with('success', 'Discount coupon created successfully!');
    }

    public function show(DiscountCoupon $discountCoupon){}
    public function edit($couponId
    {
        $coupon= DiscountCoupon::find($couponId);
        if (empty($coupon)) {
            return redirect()->route('admin.coupons.index')
                ->with('error', 'Coupon not found.');
        }
        return view('admin.discount_coupon.edit', compact('coupon'));
    }
    public function update(Request $request,  $couponId)
    {
        $coupon= DiscountCoupon::find($couponId);
        if (empty($coupon)) {
            return redirect()->route('admin.coupons.index')
                ->with('error', 'Coupon not found.');
        }
        $validated = $request->validate([
            'code' => 'required|string|unique:discount_coupons,code,'.$coupon->id.',id|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer|min:0',
            'max_uses_user' => 'nullable|integer|min:0',
            'type' => 'required|in:percent,fixed',
            'discount' => 'required|numeric|min:0',
            'min_purchased' => 'nullable|numeric|min:0',
            'status' => 'required|boolean',
            'starts_at' => 'nullable|date|before_or_equal:ends_at',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Create a new DiscountCoupon instance and fill it with validated data
        $coupon->code = $validated['code'];
        $coupon->name = $validated['name'] ?? null;
        $coupon->description = $validated['description'] ?? null;
        $coupon->max_uses = $validated['max_uses'] ?? null;
        $coupon->max_uses_user = $validated['max_uses_user'] ?? null;
        $coupon->type = $validated['type'];
        $coupon->discount = $validated['discount'];
        $coupon->min_purchased = $validated['min_purchased'] ?? 0;
        $coupon->status = $validated['status'];
        $coupon->starts_at = $validated['starts_at'] ?? null;
        $coupon->ends_at = $validated['ends_at'] ?? null;

        // Save the discount coupon to the database
        $coupon->save();

        // Redirect to the index page with a success message
        return redirect()->route('admin.coupons.index')->with('success', 'Discount coupon updated successfully!');
    }
    public function destroy($couponId)
    {
        $coupon= DiscountCoupon::find($couponId);
        if (empty($coupon)) {
            return redirect()->route('admin.coupons.index')
                ->with('error', 'Coupon not found.');
        }
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Discount coupon deleted successfully!');
    }
}
