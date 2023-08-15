<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'date', 'time', 'address_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
