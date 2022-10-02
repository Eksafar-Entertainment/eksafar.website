<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComboTicket extends Model
{
    use HasFactory;
    protected $casts = [
        'event_tickets' => 'array'
    ];
}
