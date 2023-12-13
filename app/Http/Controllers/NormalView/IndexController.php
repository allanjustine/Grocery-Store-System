<?php

namespace App\Http\Controllers\NormalView;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function productList()
    {
        $categories = Category::latest()->get();
        $allProducts = Product::orderBy('product_name', 'desc')->get();

        return view('normal-view.pages.index', compact('categories', 'allProducts'));
    }

    public function categoryList(Category $category)
    {

        $categories = Category::orderBy('name', 'asc')->with('products')->get();

        return view('normal-view.pages.category-list', compact('category', 'categories'));
    }

    public function orders()
    {

        $orders = Order::orderBy('created_at', 'asc')->where('user_id', auth()->id())->with('product')->paginate(10);

        return view('normal-view.orders.index', compact('orders'));
    }

    public function confirmOrder(Cart $cart)
    {
        return view('normal-view.orders.confirm-orders', compact('cart'));
    }

    public function orderCreate(Request $request, Product $product)
    {
        $request->validate([
            'payment_method'        =>          ['required']
        ]);
        if ($product) {

            if ($product->stock == 0) {
                return back()->with('error', 'The product is out of stock or not available. Please select another one.');
            } else {

                $orderQuantity = $request->order_quantity;

                if ($product->stock < $orderQuantity) {
                    return back()->with('error', 'You entered an excess amount - stock left:(' . $product->stock . ')');
                } else {
                    $itemCode = Str::random(10);

                    $order = Order::create([
                        'product_id'       => $request->product_id,
                        'order_quantity'   => $orderQuantity,
                        'status'           => "Pending",
                        'item_code'        => $itemCode,
                        'payment_method'   => $request->payment_method,
                        'user_id'          => auth()->id()
                    ]);
                }

                $product->decrement('stock', $order->order_quantity);
                $product->increment('sold', $order->order_quantity);

                $productName = $product->product_name;

                $log_entry = Auth::user()->fname . " has ordered product: " . $productName . " with the id# " . $product->id;
                event(new UserLog($log_entry));

                $cartItem = Cart::where('product_id', $request->product_id)
                    ->where('user_id', auth()->id())
                    ->first();

                if ($cartItem) {
                    $cartItem->delete();
                }

                return redirect('/orders')->with('message', 'Ordered successfully');
            }
        } else {
            return back()->with('error', 'Product not found. Please try again.');
        }
    }

    public function cancelled(Order $order)
    {
        $product = $order->product;
        $product->increment('stock', $order->order_quantity);
        $product->decrement('sold', $order->order_quantity);

        $order->delete();
        $productName = $product->product_name;

        $log_entry = Auth::user()->fname . " has cancelled order: " . $productName . " with the id# " . $order->id;
        event(new UserLog($log_entry));

        return redirect('/orders')->with('message', 'Order cancelled successfully');
    }

    public function reviewRating(Order $order)
    {
        return view('normal-view.orders.review', compact('order'));
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;

        $products = Product::where('product_name', 'like', "%$search%")
            ->orWhere('price', 'like', "%$search%")
            ->orWhereHas('category', function ($categoryQuery) use ($search) {
                $categoryQuery->where('name', 'like', "%$search%");
            })
            ->get();

        return view('normal-view.pages.searched', compact('search', 'products'));
    }
}
