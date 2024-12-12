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
<<<<<<< HEAD
=======
>>>>>>> 58cd14f9de8448c5d8b0e96ffde43844c27589b7
    public function roomCategory()
    {
        return $this->belongsTo(RoomType::class, 'id_room_categories');
    }
    public function bookings()
    {
        return $this->hasMany(RentalDetail::class, 'room_id');
    }
<<<<<<< HEAD
=======
>>>>>>> 3de6771 (Initial commit)
=======
>>>>>>> bf66bb5 (Initial commit)
=======
>>>>>>> 58cd14f9de8448c5d8b0e96ffde43844c27589b7
}
