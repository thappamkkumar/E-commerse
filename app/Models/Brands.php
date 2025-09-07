<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
	protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
				'image',
        'is_active',
    ];
		
		public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
