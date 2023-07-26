<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\HinhAnhThanhPhoController;
use App\Http\Controllers\Api\ImageKSController;
use App\Http\Controllers\Api\ImageLoaiPhongController;
use App\Http\Controllers\ChuKhachSanWebContronller;
use App\Http\Controllers\CTDDPWebController;
use App\Http\Controllers\DiaDiemDuLichWebController;
use App\Http\Controllers\DonDatPhongController;
use App\Http\Controllers\KhachHangWebController;
use App\Http\Controllers\KhachSanWebController;
use App\Http\Controllers\LoaiPhongWebController;
use App\Http\Controllers\PhongConLaiWebController;
use App\Http\Controllers\seachWebController;
use App\Http\Controllers\searchKhachSanController;
use App\Http\Controllers\SuKienWebController;
use App\Http\Controllers\ThanhPhoWebWebController;
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
Route::resource('admin/thanhpho', ThanhPhoWebWebController::class);
Route::get('admin/thanhpho/{MaTP}/delete', [ThanhPhoWebWebController::class, 'destroy']);
//khách sạn
Route::resource('admin/khachsan', KhachSanWebController::class);
//Địa điểm du lịch
Route::resource('/admin/diadiemdulich', DiaDiemDuLichWebController::class);
Route::get('admin/diadiemdulich/{MaDDDL}/delete', [DiaDiemDuLichWebController::class, 'destroy']);
Route::get('admin/diadiemdulich/{MaDDDL}', [DiaDiemDuLichWebController::class, 'destroy_image']);
//Sự kiện
Route::resource('/admin/sukien', SuKienWebController::class);
Route::get('admin/sukien/{maSuKien}/delete', [SuKienWebController::class, 'destroy']);
Route::get('admin/sukien/{maSuKien}', [SuKienWebController::class, 'destroy_image']);
//Chủ khách sạn 
Route::resource('admin/khthanthiet', ChuKhachSanWebContronller::class);
//Khách hàng tiềm năng
Route::resource('admin/khtiemnang', KhachHangWebController::class);

//Hình thành phố
Route::resource('admin/imgthanhpho', HinhAnhThanhPhoController::class);
Route::get('/admin/imgthanhpho/delete/{MaTP}', [ThanhPhoController::class, 'destroy_image']);

//Tìm kiếm
Route::get('/admin/seach');
Route::get('adminKS/{ADMINKS}', [AdminController::class, 'index']);
//Đăng nhập 

Route::get('login/', [ChuKhachSanWebContronller::class, 'login']);
Route::post('login/', [ChuKhachSanWebContronller::class, 'check_loginWeb']);
Route::get('logout', [ChuKhachSanWebContronller::class, 'logout']);




//loại phòng

Route::get('adminKS/loaiphong/findbyKS/{UIDKS}', [LoaiPhongWebController::class, 'getloaiphongbyks']);
Route::resource('adminKS/loaiphong/findbyKS', LoaiPhongWebController::class);
Route::get('adminKS/loaiphong/findbyKS/{UIDLoaiPhong}/show', [LoaiPhongWebController::class, 'show']);
Route::post('adminKS/loaiphong/findbyKS/{UIDKS}', [LoaiPhongWebController::class, 'store']);
Route::get('/adminKS/loaiphong/findbyKS/{UIDKS}/create', [LoaiPhongWebController::class, 'create']);

// Route::get('adminKS/loaiphong/findbyKS/{UIDKS}/delete/{UIDLoaiPhong}', [LoaiPhongController::class, 'destroy']);
Route::get('adminKS/loaiphong/findbyKS/{UIDLoaiPhong}/delete', [LoaiPhongWebController::class, 'destroy']);

Route::put('adminKS/loaiphong/findbyKS/{UIDKS}/{UIDLoaiPhong}', [LoaiPhongWebController::class, 'update']);
//Đơn đặt phòng
Route::resource('adminKS/dondatphong', DonDatPhongController::class);
Route::post('adminKS/dondadat/findbyKS', [DonDatPhongController::class, 'checkDonDatPhong'])->name('adminKS.dondadat.findbyKS');
Route::post('adminKS/dondangdienra/findbyKS', [DonDatPhongController::class, 'dondangdienra']);
Route::post('adminKS/dondahuy/findbyKS', [DonDatPhongController::class, 'dondahuy']);
Route::post('adminKS/lichsu/findbyKS', [DonDatPhongController::class, 'lichsu']);
// Chi thiết đơn đặt phòng
Route::get('adminKS/dondadat/findbyKS/{MaDDP}', [CTDDPWebController::class, 'show']);

//Phòng còn lại
Route::get('adminKS/phongconlai/findbyKS/{UIDKS}', [PhongConLaiWebController::class, 'quanlyphongconlai']);

//profile
Route::get('adminKS/profile/findbyKS/{ADMIKS}', [ChuKhachSanWebController::class, 'profile']);

//seach admin hệ thống
Route::post('admin/search', [seachWebController::class, 'TimKiem']);
Route::post('adminKS/search/findbyKS/', [searchKhachSanController::class, 'search']);

//Hình ảnh khách sạn
Route::get('adminKS/hinhanhKS/findbyKS/{ADMINKS}', [ImageKSController::class, 'hienthi']);


Route::get('admin/imgkhachsan', [ImageKSController::class, 'hienthi']);
//
Route::get('image/loaiphong/{filename}', [ImageLoaiPhongController::class, 'ShowImage']);

//Xóa hình
Route::get('adminKS/delete/image/loaiphong/{src}', [LoaiPhongWebController::class, 'destroy_image']);
Route::get('admin/delete/image/sukien/{src}', [SuKienWebController::class, 'destroy_image']);
Route::get('admin/delete/image/diadiemdulich/{src}', [DiaDiemDuLichWebController::class, 'destroy_image']);
//Tài khoản khách sạn
Route::get('adminKS/khachsan/findbyKS/{UIDKS}', [KhachSanWebController::class, 'getks']);
Route::get('adminKS/khachsan/findbyKS/{UIDKS}/show', [KhachSanWebController::class, 'showKS']);
Route::get('adminKS/khachsan/findbyKS/{UIDKS}/edit', [KhachSanWebController::class, 'editKS']);
