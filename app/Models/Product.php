<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        "name","slug","image","brand","price","price_new",
        "quantity","description","like","sale","status","view","category_id"
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function size(){
        return $this->belongsToMany(Size::class);
    }
    public function color(){
        return $this->belongsToMany(Color::class);
    }
    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function order_detail()
    {
        return $this->belongsToMany(OrderDetail::class);
    }
}
