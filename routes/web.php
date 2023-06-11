<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\KhachSanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/admin', function () {
    return view('deshbord');
});
// khách sạn
Route::get('/hotel', function () {
    return view('khachsan.hotel');
});
Route::get('/create', function () {
    return view('khachsan.create');
});
// Thành phố
Route::get('/city', function () {
    return view('thanhpho.city');
});

Route::get('/createTP', function () {
    return view('thanhpho.create');
});
//Sự Kiện
Route::get('/event', function () {
    return view('sukien.event');
});
Route::get('/createSK', function () {
    return view('sukien.create');
});
//Địa điểm du lịch
Route::get('/tourist', function () {
    return view('diadiemdulich.tourist');
});
Route::get('/createDDDL', function () {
    return view('diadiemdulich.createDDDL');
});
//khách hàng thân thiết (chủ khách sạn)
Route::get('/chuKS', function () {
    return view('chukhachsan.hotelier');
});
//khách hàng tiềm năng
Route::get('/user', function () {
    return view('khachhang.user');
});
//kh
// Route::resource('/admin/loaiphong',LoaiPhongController::class);
//    // return view('loaiphong.index');

//  Route::resource('/admin/khachsan',KhachSanController::class);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
