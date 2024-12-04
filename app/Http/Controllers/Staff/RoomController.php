<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\RoomRequest;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function getData()
    {
        $data = Room::all();
        return response()->json([
            'room' => $data
        ]);
    }
    public function store(RoomRequest $request)
    {
        $data = $request->all();
        return response()->json([$data]);
        // if(Room::create($data))
        // {
        //     return response()->json([
        //         'status'    =>  true,
        //         'message'   =>  'Đã tạo mới phòng thành công!'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status'    =>  false,
        //         'message'   =>  'Lỗi'
        //     ]);
        // }
    }
    public function update(Request $request)
    {
        $data   = $request->all();

        if(Room::find($request->id)->update($data))
        {
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã cập nhật phòng thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Lỗi'
            ]);
        }
    }
    public function destroy($id)
    {
        if(Room::find($id)->delete())
        {
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã xoá phòng thành công!'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Lỗi'
            ]);
        }
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(
            [
                'message'=>'success'
            ],
            200
        );
    }
}
