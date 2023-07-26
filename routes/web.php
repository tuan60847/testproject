<?php

use App\Http\Controllers\Api\HinhAnhThanhPhoController;
use App\Http\Controllers\ChuKhachSanController;
use App\Http\Controllers\CTDDPController;
use App\Http\Controllers\DiaDiemDuLichController;
use App\Http\Controllers\DonDatPhongController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KhachSanController;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\SuKienController;
use App\Http\Controllers\ThanhPhoController;
use App\Models\Dondatphong;
use Illuminate\Support\Facades\Route;

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
//     return view('home');
// });

Route::get('/admin', function () {
    return view('home');
});

//thành phố
// Route::get('/admin/thanhpho', [ThanhPhoController::class, 'index']);
// Route::get('/admin/thanhpho/create', [ThanhPhoController::class, 'create']);
Route::resource('admin/thanhpho', ThanhPhoController::class);
Route::get('admin/thanhpho/{MaTP}/delete', [ThanhPhoController::class, 'destroy']);
//khách sạn
Route::resource('admin/khachsan', KhachSanController::class);
//Địa điểm du lịch
Route::resource('/admin/diadiemdulich', DiaDiemDuLichController::class);
Route::get('admin/diadiemdulich/{MaDDDL}/delete', [DiaDiemDuLichController::class, 'destroy']);
Route::get('admin/diadiemdulich/{MaDDDL}', [DiaDiemDuLichController::class, 'destroy_image']);
//Sự kiện
Route::resource('/admin/sukien', SuKienController::class);
Route::get('admin/sukien/{maSuKien}/delete', [SuKienController::class, 'destroy']);
Route::get('admin/sukien/{maSuKien}', [SuKienController::class, 'destroy_image']);
//Chủ khách sạn 
Route::resource('admin/khthanthiet', ChuKhachSanController::class);
//Khách hàng tiềm năng
Route::resource('admin/khtiemnang', KhachHangController::class);

//Hình thành phố
Route::resource('admin/imgthanhpho', HinhAnhThanhPhoController::class);
Route::get('/admin/imgthanhpho/delete/{MaTP}', [ThanhPhoController::class, 'destroy_image']);

//Tìm kiếm
Route::get('/admin/seach');

//admin khách sạn
Route::get('adminKS/{ADMINKS}', function () {
    return view('deshbord');
});
//Đăng nhập 

Route::get('login/', [ChuKhachSanController::class, 'login']);
Route::post('login/', [ChuKhachSanController::class, 'check_loginWeb']);
Route::get('logout', [ChuKhachSanController::class, 'logout']);




//loại phòng

Route::get('adminKS/loaiphong/findbyKS/{UIDKS}', [LoaiPhongController::class, 'getloaiphongbyks']);
Route::resource('adminKS/loaiphong/findbyKS', LoaiPhongController::class);
Route::get('adminKS/loaiphong/findbyKS/{UIDKS}/show/{UIDLoaiPhong}', [LoaiPhongController::class, 'show']);
Route::post('adminKS/loaiphong/findbyKS/{UIDKS}', [LoaiPhongController::class, 'store']);
Route::get('adminKS/loaiphong/findbyKS/{UIDKS}/{UIDLoaiPhong}/delete', [LoaiPhongController::class, 'destroy']);
Route::put('adminKS/loaiphong/findbyKS/{UIDKS}/{UIDLoaiPhong}', [LoaiPhongController::class, 'update']);
//Đơn đặt phòng
Route::resource('adminKS/dondatphong', DonDatPhongController::class);
// Route::post('adminKS/dondadat/findbyKS', [DonDatPhongController::class, 'checkDonDatPhong']);
// Route::post('adminKS/dondahoanthanh/findbyKS', [DonDatPhongController::class, 'checkDonDatPhong']);
Route::post('adminKS/dondadat/findbyKS', [DonDatPhongController::class, 'checkDonDatPhong'])->name('adminKS.dondadat.findbyKS');
Route::post('adminKS/dondangdienra/findbyKS', [DonDatPhongController::class, 'dondangdienra']);
Route::post('adminKS/dondahuy/findbyKS', [DonDatPhongController::class, 'dondahuy']);
Route::post('adminKS/lichsu/findbyKS', [DonDatPhongController::class, 'lichsu']);
// Chi thiết đơn đặt phòng
Route::get('adminKS/dondatphong/findbyKS/{MaDDP}', [CTDDPController::class, 'showWeb']);
