<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'event_id', 'totalTicket'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
