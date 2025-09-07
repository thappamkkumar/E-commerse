<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
	protected $fillable = [
        'user_id', 'product_id', 'transaction_id', 'status', 'amount', 'transaction_details',
    ];

    /**
     * Get the product that belongs to the transaction.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	/**
     * Get the orders associated with the transaction.
     */
    public function orders()
    {
        return $this->hasOne(Order::class);
    }
}
