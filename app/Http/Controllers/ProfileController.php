<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

        return view('profile.profile', [
            'user' => $request->user(),
            'categories' => $categories,
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
