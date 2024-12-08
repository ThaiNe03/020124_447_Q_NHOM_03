<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table='rooms';
    protected $fillable = [
        'room_name',
        'price',
        'status',
        'id_room_categories',
        'more_service',
    ];
<<<<<<< HEAD
<<<<<<< HEAD
    public function roomCategory()
    {
        return $this->belongsTo(RoomType::class, 'id_room_categories');
    }

    public function bookings()
    {
        return $this->hasMany(RentalRoom::class, 'room_id');
    }
=======
>>>>>>> 3de6771 (Initial commit)
=======
>>>>>>> bf66bb5 (Initial commit)
}
