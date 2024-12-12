<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin
use App\HTTP\Controllers\Admin\UserController;
use App\HTTP\Controllers\Admin\CateRoomController;
use App\HTTP\Controllers\Admin\ServiceController;
use App\HTTP\Controllers\Admin\ProductController;

// Staff
use App\Http\Controllers\Staff\BlogController;
use App\Http\Controllers\Staff\RoomController;
use App\Models\Blog;

// Main
use App\Http\Controllers\Main\CustomerController;
use App\Http\Controllers\RentalDetailController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/admin/login',[UserController::class,'loginAdmin']);
// Admin
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[UserController::class,'logout']);
    // Profile
    Route::get('/profile',[UserController::class,'index']);
    Route::post('/update',[UserController::class,'updateAdmin']);
    // Staff
    Route::get('/list-staff',[UserController::class,'staffList']);
    Route::post('/create-staff',[UserController::class,'staffCreate']);
    Route::delete('/delete-staff/{id}',[UserController::class,'destroy']);
    // Category room
    Route::get('/list-cate-room',[CateRoomController::class,'index']);
    Route::post('/create-cate-room',[CateRoomController::class,'store']);
    Route::get('/edit-cate-room/{id}',[CateRoomController::class,'edit']);
    Route::post('/edit-cate-room/{id}',[CateRoomController::class,'update']);
    Route::delete('/delete-cate-room/{id}',[CateRoomController::class,'destroy']);
    // Service
    Route::get('/list-service',[ServiceController::class,'index']);
    Route::post('/create-service',[ServiceController::class,'store']);
    Route::delete('/delete-service/{id}',[ServiceController::class,'destroy']);
    // Category product
    Route::get('/list-cate-product',[ProductController::class,'listCate']);
    Route::post('/create-cate-product',[ProductController::class,'storeCate']);
    Route::delete('/delete-cate-product/{id}',[ProductController::class,'destroyCate']);
    // Product
    Route::get('/list-product',[ProductController::class,'index']);
    Route::post('/create-product',[ProductController::class,'store']);
    Route::get('/edit-product/{id}',[ProductController::class,'edit']);
    Route::post('/edit-product/{id}',[ProductController::class,'update']);
    Route::delete('/delete-product/{id}',[ProductController::class,'destroy']);
});

// Staff
Route::post('/staff/login',[UserController::class,'loginStaff']);
Route::prefix('staff')->middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[RoomController::class,'logout']);
    // Room
    Route::get('/list-room', [RoomController::class, 'getData']);
    Route::post('/create-room',[RoomController::class, 'store']);
    Route::get('/edit-room/{id}',[RoomController::class,'edit']);
    Route::put('/edit-room/{id}',[RoomController::class, 'update']);
    Route::delete('/delete-room/{id}', [RoomController::class, 'destroy']);
<<<<<<< HEAD
    //product
    Route::get('/list-product',[ProductController::class,'index']);
    Route::put('/change-status', [ProductController::class, 'change']);
=======
    // Product
    Route::get('/list-product',[ProductController::class,'index']);
    Route::put('/change-status', [ProductController::class, 'change']);
    // Blog
<<<<<<< HEAD
    Route::get('/list-prodbloguct',[ProductController::class,'index']);

>>>>>>> b6c9bb129c26db66902e5f24344ac69c9c910be4
=======
    Route::get('/list-blog',[BlogController::class,'index']);
    Route::post('/create-blog',[BlogController::class,'store']);
    Route::get('/edit-blog/{id}',[BlogController::class,'edit']);
    Route::put('/edit-blog/{id}',[BlogController::class,'update']);
    Route::delete('/delete-blog',[BlogController::class,'destroy']);
    // Rental room detail
    Route::post('/create-rental-detail', [RentalDetailController::class, 'store']);
>>>>>>> 163989666b769ef694cf182baf20f5c3928731f4
});

Route::post('/register', [CustomerController::class, 'register']);
Route::post('/login', [CustomerController::class, 'login']);

// Main
Route::get('/list-room', [RoomController::class, 'getData']);
Route::get('/edit-room/{id}',[RoomController::class,'edit']);
Route::get('/list-service',[ServiceController::class,'index']);
Route::get('/list-product',[ProductController::class,'index']);



// Main sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[CustomerController::class,'logout']);
    Route::post('/choose-room',[CustomerController::class,'chooseRoom']);
    Route::post('/booking',[CustomerController::class,'booking']);
});
