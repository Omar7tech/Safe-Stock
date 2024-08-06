<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Supplier extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'email',
        'contact_person',
        'website',
        'tax_id',
        'bank_account',
        'notes',
         'pinned'
    ];

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getEncodedIdAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }
}
