<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        $cartContent = Cart::content();
        return view('front.cart', compact('categories', 'cartContent'));
    }

    public function addToCart($product_id)
    {
        $product = Product::with('productImages')->find($product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        // Check if product is already in the cart
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicates->isNotEmpty()) {
            return redirect()->back()->with('error', 'Product already in cart.');
        }

        // Add product to cart
        Cart::add(
            $product->id,
            $product->title,
            1,
            $product->price,
            ['productImage' => $product->productImages->first() ?? '']
        )->associate('App\Models\Product');

        return redirect()->route('cart')->with('success', '<strong>' . $product->title . '</strong> added to cart successfully.');
    }

    public function clearCart(Request $request)
    {

    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);
        $status = false;
        $message = '';
        if ($product->track_qty == 'yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully.';
                $status = true;
                session()->flash('success', $message);
            } else {
                $message = 'Requested qty (' . $qty . ') not in stock.';
                session()->flash('error', $message);

            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully.';
            $status = true;
            session()->flash('success', $message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $itemInfo = Cart::get($request->rowId);
        $message = '';
        if (!$itemInfo) {
            $message = 'Item not found in cart.';
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }
        Cart::remove($request->rowId);
        $message = 'Item removed from cart successfully.';
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

}
