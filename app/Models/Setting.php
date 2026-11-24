<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'business_name', 'whatsapp_number', 'address',
        'opening_hours', 'instagram_url', 'about',
    ];
}