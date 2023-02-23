<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpRecords extends Model
{
    use HasFactory;
    protected $fillable = ["otp", "mobile_no", "expires_at", "is_valid"];
}
