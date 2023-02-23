<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["uid", "event_id", "promoter_id", "name", "email", "mobile", "status", "total_price", "payment_id"]; 
}
