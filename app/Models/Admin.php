<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
	protected $fillable = [
        'webSiteName', 
        'merchantId', 
        'saltKey', 
        'email', 
        'address', 
        'addressMapUrl', 
        'contact',  
        'instagram',  
        'facebook',  
        'youtube',  
        'logo',  
        'homeImage',  
        'homeHeading',  
        'homeDiscount',  
		
    ]; 
}
