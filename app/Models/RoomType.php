<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table='room_categories';
    protected $fillable = [
        'room_type',
        'adult',
        'children',
        'size',
        'image',
        'status'
    ];
<<<<<<< HEAD
<<<<<<< HEAD
    public function rooms()
    {
        return $this->hasMany(Room::class, 'id_room_categories');
    }

=======
>>>>>>> 3de6771 (Initial commit)
=======
>>>>>>> bf66bb5 (Initial commit)
}
