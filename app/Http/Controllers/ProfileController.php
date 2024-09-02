<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();

        $user= User::where('id', Auth::id())->first();
        $countries = Country::orderBy('name', 'ASC')->get();

        $address= CustomerAddress::where('user_id',$user->id)->first();

        return view('profile.profile',compact('user', 'countries', 'categories', 'address'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:11',
        ]);

        try {
            // Update the user's profile
            $user = $request->user();
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->save();
        } catch (ValidationException $e) {
            return Redirect::back()->withErrors($e->errors())->withInput();
        }
        // Redirect with a success message
        return Redirect::route('profile')->with('success', 'profile-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10'
        ]);
        $user = auth()->user();
        $customer_address = CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'],
                'country_id' => $validated['country'],
                'address' => $validated['address'],
                'apartment' => $validated['apartment'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip' => $validated['zip']
            ]
        );
        return Redirect::back()->with('success', 'address-updated');
    }
    public function myOrders()
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();

        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('profile.my-orders', compact('categories', 'orders'));
    }

    public function myOrderDetails(Request $request, Order $order)
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        $order->load('orderItems');
        $orderItemsCount = $order->orderItems()->count();
        return view('profile.order-details', compact('categories', 'order', 'orderItemsCount'));
    }

    public function wishlist(Request $request)
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        $wishlists = Wishlist::where('user_id', auth()->id())->with('product')->get();

        return view('profile.wishlist', compact('categories', 'wishlists'));
    }

    public function removeFromWishlist(Request $request, Wishlist $wishlist)
    {
        $wishlist->delete();
        return Redirect::back()->with('success', 'Product removed from wishlist');
    }
}
