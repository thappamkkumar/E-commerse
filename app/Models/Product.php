<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'categories_id','brand_id',  'name', 'slug', 'price', 'sale_price', 'gst', 'description', 'specification', 'stock', 'video_url', 'images', 'thumnail', 'is_active',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
	/**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brands::class );
    }

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	/**
     * Get the carts associated with the product.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
	/**
     * Get the orders associated with the product.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
	 /**
     * Get the transactions associated with the product.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
	 /**
     * Get the reviews associated with the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
