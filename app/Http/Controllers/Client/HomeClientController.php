<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class HomeClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $countCart=Cart::where('user_id', $user->id)->count();

        return view('client.layouts.main', [
            'title' => 'Trang chủ',
            'product' => Product::latest()->paginate(16),
            'category' => Category::all(),
            'countCart' =>$countCart
        ]);
    }

}
