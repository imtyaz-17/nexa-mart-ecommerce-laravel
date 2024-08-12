<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
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

    public function checkout()
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        if (Cart::count() == 0) {
            return redirect()->route('cart');
        }
        $countries=Country::orderBy('name', 'ASC')->get();
        $customerAddress = CustomerAddress::where('user_id', auth()->user()->id)->first();
        return view('front.checkout', compact('categories','countries', 'customerAddress'));
    }

    public function processCheckout(Request $request)
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
            'zip' => 'required|string|max:10',
            'order_notes' => 'nullable|string|max:1000',
        ]);

        // Customer Address store
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
                'zip' => $validated['zip'],
                'order_notes' => $validated['order_notes'],
            ]
        );

        // Store data in Order table
        if ($request->payment_method == 'cod') {
            $subtotal = Cart::subtotal(2, '.', '');
            $shipping = 0;
            $discount = 0;
            $grandTotal = $subtotal + $shipping;

            $order = new Order;
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->customer_address_id = $customer_address->id;
            $order->user_id = $user->id;
            $order->save();

            //Store shopping items in Order items table
            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->total * $item->qty;
                $orderItem->save();
            }
            Cart::destroy();
            return redirect()->route('thanks', $order->id)->with('success', 'Placed your order successfully.');
        }
        else {
            return redirect()->route('thanks', 1)->with('success', 'Placed your order successfully.');
        }
    }
    public  function thankYou($orderId){
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        return view('front.thank-you', compact('categories'));
    }
}
