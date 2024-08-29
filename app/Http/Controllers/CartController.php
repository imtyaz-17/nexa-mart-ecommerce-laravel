<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use Carbon\Carbon;
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
        // Get active categories with subcategories
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')
            ->get();

        // Redirect to cart page if the cart is empty
        if (Cart::count() == 0) {
            return redirect()->route('cart');
        }

        // Get all countries for the dropdown
        $countries = Country::orderBy('name', 'ASC')->get();

        // Get the customer's saved address
        $customerAddress = CustomerAddress::where('user_id', auth()->user()->id)->first();

        // Initialize shipping charge and grand total
        $shippingCharge = 0;
        $discount = 0;
        $grandTotal = (float)Cart::subtotal(2, '.', '');

        // Calculate shipping charge and grand total if customer has an address
        if ($customerAddress) {
            $shippingInfo = ShippingCharge::where('country_id', $customerAddress->country_id)->first();
            if ($shippingInfo) {
                $shippingCharge = (float)$shippingInfo->amount;
                $grandTotal += $shippingCharge;
            }
        }

        // Return the checkout view with the necessary data
        return view('front.checkout', compact('categories', 'countries', 'customerAddress', 'shippingCharge', 'discount', 'grandTotal'));
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

            $shipping = $request->shipping;
            $discount = 0;
            $discount_coupon_id = null;
            // Calculate Discount
            if (session()->has('code')) {
                $code = session()->get('code');
                if ($code->type == 'percent') {
                    $discount = ($code->discount / 100) * $subtotal;
                } else {
                    $discount = $code->discount;
                }
                $discount_coupon_id = $code->id;
            }

            $grandTotal = ($subtotal - $discount) + $shipping;

            $order = new Order;
            $order->customer_address_id = $customer_address->id;
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->discount = $discount;
            $order->grand_total = $grandTotal;
            $order->user_id = $user->id;
            $order->discount_coupon_id = $discount_coupon_id;
            $order->payment_status = 'unpaid';
            $order->delivery_status = 'pending';
            $order->save();

            //Store shopping items in Order items table
            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();
            }

            // Send Order Email
            orderEmail($order->id, 'customer');

            Cart::destroy();
            session()->forget('code');

            return redirect()->route('thanks', $order->id)->with('success', 'Placed your order successfully.');
        } else {
            return redirect()->route('thanks', 1)->with('success', 'Placed your order successfully.');
        }
    }

    public function getOrderSummary(Request $request)
    {
        $subTotal = (float)Cart::subtotal(2, '.', '');
        $discount = 0;
        $discountString = '';
        // Calculate Discount
        if (session()->has('code')) {
            $code = session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount / 100) * $subTotal;
            } else {
                $discount = $code->discount;
            }
            $discountString = '<div class="mt-2" id="coupon-close">
                                <strong>' . session()->get('code')->code . '</strong>
                                <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
                            </div>';
        }


        $countryId = $request->country_id;
        if ($countryId > 0) {
            // Determine the shipping information based on the country_id
            $shippingInfo = ShippingCharge::where('country_id', $countryId)->first();

            // If no specific country shipping info is found, use "Rest of the World" (id 99991)
            if (!$shippingInfo) {
                $shippingInfo = ShippingCharge::where('country_id', 99991)->first();
            }
            // Calculate shipping charge
            $shippingCharge = (float)$shippingInfo->amount;
            $grandTotal = ($subTotal - $discount) + $shippingCharge;

            return response()->json([
                'status' => true,
                'shippingCharge' => number_format($shippingCharge, 2),
                'discount' => number_format($discount, 2),
                'discountString' => $discountString,
                'grandTotal' => number_format($grandTotal, 2),
            ]);
        } else {
            return response()->json([
                'status' => true,
                'shippingCharge' => 0,
                'discount' => number_format($discount, 2),
                'discountString' => $discountString,
                'grandTotal' => number_format(($subTotal - $discount), 2),
            ]);
        }
    }

    public function applyDiscount(Request $request)
    {
        $code = DiscountCoupon::where('code', $request->code)->first();
        if (!$code) {
            return response()->json([
                'status' => false,
                'error' => 'Invalid discount coupon code',
            ]);
        }
        $now = Carbon::now();
        if ($code->starts_at != '') {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->starts_at);

            if ($now->lt($startDate)) {
                return response()->json([
                    'status' => false,
                    'error' => 'Invalid discount coupon code',
                ]);
            }
        }
        if ($code->ends_at != '') {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->ends_at);

            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'error' => 'Invalid discount coupon code',
                ]);
            }
        }

        //minimum purchased amount
        $subTotal = (float)Cart::subtotal(2, '.', '');
        if ($code->min_purchased>0){
            if($subTotal<$code->min_purchased){
                return response()->json([
                    'status' => false,
                    'error'=>'Your purchased amount must be greater than '.$code->min_purchased,
                ]);
            }
        }
        // Coupon Max Uses
        if ($code->max_uses > 0) {
            $couponUsed = Order::where('discount_coupon_id', $code->id)->count();
            if ($couponUsed >= $code->max_uses) {
                return response()->json([
                    'status' => false,
                    'error' => 'Discount coupon code limit reached',
                ]);
            }
        }

        // Coupon User Max Uses
        if ($code->max_uses_user > 0) {
            $couponUsedByUser = Order::where(['discount_coupon_id' => $code->id, 'user_id' => auth()->user()->id])->count();
            if ($couponUsedByUser >= $code->max_uses_user) {
                return response()->json([
                    'status' => false,
                    'error' => 'You already used this coupon',
                ]);
            }
        }

        session()->put('code', $code);
        return $this->getOrderSummary($request);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }

    public function thankYou($orderId)
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        return view('front.thank-you', compact('categories'));
    }
}
