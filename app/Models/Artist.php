<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image', 
        'email', 
        'phone',
        'excerpt', 
        'description',
        'tags', 
        'cover', 
    ];
}
