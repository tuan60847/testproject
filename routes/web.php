<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\KhachSanController;
use App\Http\Controllers\ThanhphoController;
use App\Http\Controllers\DiaDiemDuLichController;
use App\Http\Controllers\SuKienController;
use App\Http\Controllers\Api\HinhAnhThanhPhoController;
use App\Http\Controllers\Api\HinhAnhDiaDiemDuLichController;
use App\Http\Controllers\Api\HinhAnhSuKienController;

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
//khách hàng thân thiết (chủ khách sạn)
Route::get('/chuKS', function () {
    return view('chukhachsan.hotelier');
});
//khách hàng tiềm năng
Route::get('/user', function () {
    return view('khachhang.user');
});
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
//Thành phố

Route:: resource('/city',ThanhPhoController::class);
Route::get('thanhpho/{id}', [ThanhPhoController::class,'create']);
//Địa điểm du lịchs
Route:: resource('/tourist',DiaDiemDuLichController::class);
//Khách sạn
Route:: resource('/hotel',KhachSanController::class);
//Sự kiện
Route:: resource('/event',SuKienController::class);
//Hình thành phố
Route:: resource('/imgcity',HinhAnhThanhPhoController::class);
//Hình ảnh địa điểm du lịch
Route:: resource('/imgtourist',HinhAnhDiaDiemDuLichController::class);
//Hình ảnh sự kiện
Route:: resource('/imgevent',HinhAnhSuKienController::class);
