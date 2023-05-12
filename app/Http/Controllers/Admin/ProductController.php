<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'title' => "Quản lý sản phẩm",
            'products' => Product::latest()->paginate(5),
        ]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
            'category' => Category::all()
        ]);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('list.product')->with('success', 'Thành công xoá sản phẩm');
    }
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm mới sản phẩm',
            'category' => Category::all(),
            'size' => Size::all(),
            'color' => Color::all()
        ]);
    }


    public function store(CreateProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->status = $request->status;

        // Calculate sale price
        $product->sale = $request->sale;
        if ($request->sale) {
            $sale = $request->price * ($request->sale / 100);
            $price_new = $request->price - $sale;
            $product->price_new = $price_new;
        }else{
            $product->price_new = $request->price;
        }

        // Xử lý upload 1 ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $product->image = "/images/{$filename}";
        }
        $product->save();

        //Upload nhiều ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as  $key => $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $filename);
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image_path = "/images/{$filename}";
                $productImage->save();
            }
        }

        //Xử lý thêm màu sắc
        if ($request->color_id) {
            foreach ($request->color_id as $value) {
                $color = new ProductColor();
                $color->product_id = $product->id;
                $color->color_id = $value;
                $color->save();
            }
        }

        if ($request->size_id) {
            foreach ($request->size_id as $value) {
                $size = new ProductSize();
                $size->product_id = $product->id;
                $size->size_id = $value;
                $size->save();
            }
        }

        return redirect()->route('list.product')->with('success', 'Thêm mới sản phẩm thành công!');
    }






    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', [
            'title' => 'Cập nhật sản phẩm',
            'product' => $product,
            'category' => Category::all()
        ]);
    }
}
