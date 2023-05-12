<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\CreateCartRequest;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();
        $countCart=Cart::where('user_id', $user->id)->count();
        return view('client.carts.cart', [
            'title' => 'Giỏ hàng',
            'carts' => $carts,
            'category' => Category::all(),
            'countCart'=>$countCart
        ]);
    }
    public function addToCart(CreateCartRequest $request)
    {
        $user = auth()->user();
        $productId = $request->product_id;
        $sizeId = $request->size_id;
        $colorId = $request->color_id;

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->size_id = $sizeId;
            $cartItem->color_id = $colorId;
            if ($cartItem->product->sale != null) {
                $productPrice = $cartItem->product->price_new;
                $cartItem->total = $cartItem->quantity * $productPrice;
            } else {
                $productPrice = $cartItem->product->price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            }
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, tạo mới
            $cartItem = new Cart;
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $productId;
            $cartItem->size_id = $sizeId;
            $cartItem->color_id = $colorId;
            $cartItem->quantity = 1;
            if ($cartItem->product->sale != null) {
                $productPrice = $cartItem->product->price_new;
                $cartItem->total = $cartItem->quantity * $productPrice;
            } else {
                $productPrice = $cartItem->product->price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            }
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function deleteCart($id){
        $carts=Cart::find($id);
        $carts->delete();
        return redirect()->back()->with('success', 'Xoá sản phẩm thành công');
    }
    // public function tangSoLuong(Request $request ,$id){
    //     $carts=Cart::find($id);
    //     $carts->quantity=$request->quantity;
    //     $carts->save();
    //     return redirect()->back()->with('success', 'Tăng số lượng sản phẩm thành công');

    // }





}
