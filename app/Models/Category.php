<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = []; // Use guarded if you want to allow mass assignment for all fields
    // protected $fillable = ['name', 'description']; // Use fillable if you want to specify fields

    public function products()
{
    return $this->hasMany(Product::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEncodedIdAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    
}
