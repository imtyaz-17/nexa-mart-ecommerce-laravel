<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //
    public function index(Request $request){
        $shippingCharges = ShippingCharge::leftJoin('countries', 'countries.id', '=', 'shipping_charges.country_id')
            ->select('shipping_charges.*', 'countries.name');
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $shippingCharges = $shippingCharges->where('name', 'LIKE', "%{$keyword}%");
        }
        $shippingCharges = $shippingCharges->paginate(10);
        return view('admin.shipping.list',compact('shippingCharges'));
    }
    public function create(){
        $countries=Country::all();
        return view('admin.shipping.create',compact('countries'));
    }
    public function store(Request $request)
    {
        $existed=ShippingCharge::where('country_id',$request->country)->first();
        if($existed){
            return redirect()->route('admin.shipping.create')->with('error','This country shipping charge already listed');
        }
       $validated= $request->validate([
            'country'=>'required',
            'amount'=>'required|numeric',
        ]);

       $shipping=new ShippingCharge;
       $shipping->country_id=$validated['country'];
       $shipping->amount=$validated['amount'];
       $shipping->save();

       return redirect()->route('admin.shipping.index')->with('success','Shipping Charge Added Successfully');
    }
    public function show($id){}
    public function edit($shippingId)
    {
        $shippingCharge=ShippingCharge::find($shippingId);
        if (empty($shippingCharge)) {
            return redirect()->route('admin.shipping.index')
                ->with('error', 'Country not found.');
        }
        $countries=Country::all();
        return view('admin.shipping.edit',compact('countries','shippingCharge'));
    }
    public function update(Request $request, $shippingId)
    {
        $shipping=ShippingCharge::find($shippingId);
        if (empty($shipping)) {
            return redirect()->route('admin.shipping.index')
                ->with('error', 'Country not found.');
        }
        $validated= $request->validate([
            'country'=>'required',
            'amount'=>'required|numeric',
        ]);

        $shipping->country_id=$validated['country'];
        $shipping->amount=$validated['amount'];
        $shipping->save();

        return redirect()->route('admin.shipping.index')->with('success','Shipping Charge Updated Successfully');
    }
    public function destroy($shippingId)
    {
        $shipping=ShippingCharge::find($shippingId);
        if (empty($shipping)) {
            return redirect()->route('admin.shipping.index')
                ->with('error', 'Shipping data not found.');
        }
        $shipping->delete();
        return redirect()->route('admin.shipping.index')->with('success','Shipping Data Deleted Successfully');
    }
}
