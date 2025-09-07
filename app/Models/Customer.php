<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
	protected $table = 'customers';
	protected $primaryKey = 'id';
	protected $fillable = [
        'user_id', 'name', 'area_street_sector_village', 'flat_houseno_building_company',
        'landmark', 'district', 'state', 'country', 'pincode', 'profile_image',
    ];
	
	/**
     * Get the user that owns the vendor.
     */
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
