<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.categories.index',[
            'title'=>'Trang danh mục',
            'category'=>Category::latest()->paginate(5)
        ]);
    }
    public function create(){
        return view('admin.categories.add',[
            'title'=>'Thêm mới danh mục',
        ]);
    }
    public function store(CreateCategoryRequest $request, Category $category){
        $category->name=$request->name;
        $category->slug=Str::slug($request->name.'-');
        $category->status=$request->status;
        $category->save();
        return redirect()->route('create.category')->with('success','Thành công thêm mới danh mục');
    }
    public function destroy($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->route('list.category')->with('success','Thành công xoá danh mục');

    }
    public function edit($id){
        $category=Category::findOrFail($id);
        return view('admin.categories.edit',[
            'title'=>"Cập nhật thông tin danh mục",
            'category'=>$category
        ]);
    }
    public function update($id, UpdateCategoryRequest $request){
        $category=Category::find($id);
        $category->name=$request->name;
        $category->slug=Str::slug($request->name.'-');
        $category->status=$request->status;
        $category->save();
        return redirect()->route('list.category')->with('success','Thành công cập nhật danh mục '. $category->name);

    }
}
