<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["uid", "event_id", "promoter_id", "name", "email", "mobile", "status", "total_price", "payment_id"]; 

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $model->uid = Str::upper(base_convert(microtime(false), 10, 36));
        });
    }
}
