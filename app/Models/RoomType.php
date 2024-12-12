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
<<<<<<< HEAD
=======
>>>>>>> 58cd14f9de8448c5d8b0e96ffde43844c27589b7
    public function rooms()
    {
        return $this->hasMany(Room::class, 'id_room_categories');
    }
<<<<<<< HEAD

=======
>>>>>>> 3de6771 (Initial commit)
=======
>>>>>>> bf66bb5 (Initial commit)
=======
>>>>>>> 58cd14f9de8448c5d8b0e96ffde43844c27589b7
}
