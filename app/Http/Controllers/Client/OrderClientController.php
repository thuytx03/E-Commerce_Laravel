<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderClientController extends Controller
{
    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->total;
        }
        $user = auth()->user();
        $countCart = Cart::where('user_id', $user->id)->count();

        return view('client.orders.order', compact('carts', 'total'), [
            'title' => 'Trang đặt hàng',
            'countCart' => $countCart

        ]);
    }
    public function placeOrder(Request $request)
    {
        $user = auth()->user();
        // Lưu thông tin đơn hàng vào cơ sở dữ liệu
        $order = new Order();
        // $order->name = $user->name;
        // $order->email = $user->email;
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');

        // Tính tổng tiền của đơn hàng từ giỏ hàng
        $carts = Cart::where('user_id', $user->id)->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->total;
        }
        $order->total = $total;

        $order->payment = $request->input('payment');
        $order->status = 'Chưa xác nhận';
        $order->note = $request->input('note');
        $order->user_id = $user->id;
        $order->save();

        // Lưu thông tin chi tiết đơn hàng vào cơ sở dữ liệu
        foreach ($carts as $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->size_id = $cart->size_id;
            $orderDetail->color_id = $cart->color_id;
            $orderDetail->price = $cart->total / $cart->quantity;
            $orderDetail->save();
        }

        // Xóa sản phẩm trong giỏ hàng của người dùng
        Cart::where('user_id', $user->id)->delete();

        // Xử lý thanh toán ở đây (ví dụ: sử dụng Stripe)

        return redirect()->route('/')->with('success', 'Your order has been placed successfully.');
    }
    public function show()
    {
        $user = auth()->user();

        $orders = OrderDetail::select('order_details.*', 'products.name')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('sizes', 'order_details.size_id', '=', 'sizes.id')
            ->join('colors', 'order_details.color_id', '=', 'colors.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.user_id', $user->id)
            ->get();


        $countCart = Cart::where('user_id', $user->id)->count();
        return view('client.orders.show', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $orders,
            'countCart' => $countCart
        ]);
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'Đã huỷ';
        $order->save();
        return redirect()->back();
    }
    public function confirm($id)
    {
        $order = Order::find($id);
        $order->status = 'Chưa xác nhận';
        $order->save();
        return redirect()->back();
    }
}
