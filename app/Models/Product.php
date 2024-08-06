<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'sku',
        'is_active',
    ];

    /**
     * Get the category that owns the product.
     */

     public function user()
     {
         return $this->belongsTo(User::class);
     }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the supplier that owns the product.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getEncodedIdAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }
}
