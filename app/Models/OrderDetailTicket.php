<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_detail_id",
        "event_combo_ticket_id",
        "event_ticket_id",
        "uid"
    ];
}
