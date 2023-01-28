<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'buy_price',
        'sell_price',
        'stock',
        'image',
        'info',
        'category_id',
        'unit_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getProfitAttribute()
    {
        return $this->sell_price - $this->buy_price;
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . config('files.product_image_dir') . '/' . $this->image) : asset('assets/images/no-product-image.svg');
    }
}
