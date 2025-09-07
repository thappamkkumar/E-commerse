<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	 
	const ADMIN_ROLE = 1; 
    const USER_ROLE = 3;
	
    const USER_ACTIVE = 1;
    const USER_DEACTIVE = 0;
	
    protected $fillable = [
        'email', 'password', 'mobile_number',  'user_role', 'is_active', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; 
	/**
	* Get the customers associated with the user.
	*/
    public function customers()
    {
        return $this->hasOne(Customer::class);
    }
	/**
     * Get the products associated with the user who have role as Vendor.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
	/**
     * Get the carts associated with the user who have role as Customer.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
	 /**
     * Get the orders associated with the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
	/**
     * Get the transactions associated with the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
	 /**
     * Get the reviews associated with the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
	 
	 
	 
	 
	 
}
