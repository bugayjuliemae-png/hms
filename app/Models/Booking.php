<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'contact_number',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'status',
        'payment_method',
        'payment_status',
        'payment_reference',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}