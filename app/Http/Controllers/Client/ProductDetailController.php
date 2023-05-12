<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productColors = ProductColor::where('product_id', $product->id)->get();
        $productSizes = ProductSize::where('product_id', $product->id)->get();
        $user = auth()->user();
        $countCart=Cart::where('user_id', $user->id)->count();
        return view('client.products.detail', [
            'title' => 'Sản phẩm ' . $product->name,
            'productDetail' => $productImages,
            'colors' => $productColors,
            'sizes' => $productSizes,
            'product' => $product,
            'productId' => $product->id,
            'countCart'=>$countCart

        ]);
    }
}
