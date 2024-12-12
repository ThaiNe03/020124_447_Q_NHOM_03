<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Main\CustomRequest;
use Carbon\Carbon;
// use App\Http\Requests\Main\LoginRequest;
use App\Http\Requests\Main\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RentalDetail;

class CustomerController extends Controller
{
    public $successStatus = 200;
    public function Register(RegisterRequest $request){
      $data = $request->all();
        if(User::create($data)){
            return response()->json(["Create user success."]);
        }else{
            return response()->json(["Create user error."]);
        }
    }
    protected function doLogin($attempt)
    {
        if (Auth::guard('web')->attempt($attempt)) {
            return true;
        } else {
            return false;
        }
    }
    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        if ($this->doLogin($login)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                    'success' => 'success',
                    'token' => $token,
                    'type_token' => 'Bearer',
                    'Auth' => Auth::user()
                ],
                $this->successStatus
            );
        } else {
            return response()->json([
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ],
            $this->successStatus);
        }
    }
    public function logout()
    {
      auth()->user()->tokens()->delete();
      return response()->json(
          [
              'message'=>'success'
          ],
          200
      );
    }
    public function chooseRoom(Request $request){
        $quantity = $request->quantity;
        $IssueDate = Carbon::parse($request->IssueDate);
        $DueDate = Carbon::parse($request->DueDate);
        $data['start'] = $IssueDate->format('Y/m/d');
        $adult = $request->adult;
        $children = $request->children;
        $roomType = RoomType::where('Adult', $adult)
            ->where('Children', $children)
            ->first();
        if (!$roomType) {
            return response()->json(['message' => 'Không tìm thấy loại phòng phù hợp'], 404);
        }
        $activeRooms = Room::where('id_room_categories', $roomType->id)
            ->where('status', 1)
            ->get();

        $availableRooms = [];
        foreach ($activeRooms as $room) {
            $conflictFound = false;
            while ($data['start'] <= $DueDate) {
                $rentalConflict = RentalDetail::where('id_room', $room->id)
                    ->where('date', $data['start'])
                    ->where('status', 1)
                    ->exists();
                if ($rentalConflict) {
                    $conflictFound = true;
                    break; 
                }
                $data['start']->addDay();
            }
            if (!$conflictFound) {
                $availableRooms[] = $room;
            }
        }
        if (count($availableRooms) < $quantity) {
            return response()->json(['message' => 'Không đủ phòng còn trống'], 404);
        }
        
        return response()->json([
            $activeRooms,
            $availableRooms
        ]);
    }
    public function booking(Request $request)
    {
        $user = Auth()->user();
        $pricePerRoom = Room::find($availableRooms->first()->room_id)->price;
        $days = $DueDate->diffInDays($IssueDate);
        $totalPrice = $pricePerRoom * $days * $quantity;

        return response()->json([
            'message' => 'Đặt phòng thành công',
            'total_price' => $totalPrice,
            'rooms' => $availableRooms
        ]);
    }
}
