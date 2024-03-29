<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'mobile', 
        'email', 
        'excerpt', 
        'description', 
        'logo', 
        'cover', 
        'location', 
        'address', 
        'founded_at', 
        'tags', 
        "map_url"
    ];
}
