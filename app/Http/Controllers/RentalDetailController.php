<?php

namespace App\Http\Controllers;
use App\Http\Requests\Staff\RentalDatailRequest;
use App\Models\RentalDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalDetailController extends Controller
{
    public function store(RentalDatailRequest $request){
        $today      = Carbon::today();
        $lastDay    = Carbon::now()->endOfMonth();
        while($today <= $lastDay) {
            RentalDetail::firstOrCreate(
                [
                    'id_room'       =>  $request->id_room,
                    'date'          =>  $today,
                ],
                [
                    'id_room'   =>  $request->id_room,
                    'status'    =>  1,
                    'date'      =>  $today,
                    'note'      =>  $request -> note,
                ]
            );
            $today->addDay();
        }
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Crete success!',
        ]);
    }
}
