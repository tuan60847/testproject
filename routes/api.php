<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testcontrol;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\HinhAnhDiaDiemDuLichController;
use App\Http\Controllers\Api\HinhAnhSuKienController;
use App\Http\Controllers\Api\HinhAnhThanhPhoController;
use App\Http\Controllers\Api\ImageKSController;
use App\Http\Controllers\Api\ImageLoaiPhongController;
use App\Http\Controllers\ChuKhachSanController;
use App\Http\Controllers\CTDDPController;
use App\Http\Controllers\DiaDiemDuLichController;
use App\Http\Controllers\DonDatPhongController;
use App\Http\Controllers\KhachSanController;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\PhongConLaiController;
use App\Http\Controllers\SuKienController;
use App\Http\Controllers\ThanhPhoController;
use App\Models\Hinhanhdddl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Dùng Để xóa một dữ liệu
Route::delete('khachhang/{id}', [testcontrol::class,'destroy']);
// Dùng Để sử dụng các phương thức dữ liệu
Route::resource('khachhang', testcontrol::class);
Route::get('khachhang/{id}', [testcontrol::class,'show']);
Route::post('khachhang', [testcontrol::class,'store']);
Route::put('khachhang/{id}', [testcontrol::class,'update']);
Route::get('khachhang/setoff/{id}', [testcontrol::class,'setoff']);
Route::get('khachhang/seton/{id}', [testcontrol::class,'seton']);



Route::post('image/khachsan/upload',[ImageKSController::class, 'imageStore']);
Route::get('image/UIDKS/{id}',[ImageKSController::class, 'findlast']);
Route::delete('hinhanhkhachsan/image/khachsan/{src}', [ImageKSController::class,'destroy']);
Route::resource('hinhanhkhachsan', ImageKSController::class);



Route::resource('khachsan', KhachSanController::class);
Route::delete('khachsan/{id}', [KhachSanController::class,'destroy']);
Route::get('khachsan/{id}', [KhachSanController::class,'show']);
Route::get('khachsan/findbyMaDDDL/{id}', [KhachSanController::class,'findbyMaDDDL']);
Route::post('khachsan', [KhachSanController::class,'store']);
Route::put('khachsan/{id}', [KhachSanController::class,'update'])->middleware('auth:sanctum');


Route::resource('loaiphong', LoaiPhongController::class);
Route::delete('loaiphong/{id}', [LoaiPhongController::class,'destroy']);
Route::get('loaiphong/findbyKS/{id}', [LoaiPhongController::class,'getloaiphongbyks']);
Route::get('loaiphong/findnewKS/{UIDKS}', [LoaiPhongController::class,'findlast']);
Route::get('loaiphong/{id}', [LoaiPhongController::class,'show']);
Route::post('loaiphong', [LoaiPhongController::class,'store']);
// Route::put('loaiphong/UpdateSLLoaiPhong/{UIDLoaiPhong}', [LoaiPhongController::class,'UpdateSLLoaiPhong']);
Route::put('loaiphong/{id}', [LoaiPhongController::class,'update']);


Route::resource('dondatphong', DonDatPhongController::class);
Route::delete('dondatphong/{id}', [DonDatPhongController::class,'destroy']);
Route::get('dondatphong/{id}', [DonDatPhongController::class,'show']);
Route::get('dondatphong/findlastbyEmail/{EmailKH}', [DonDatPhongController::class,'lastItemByEmail']);
Route::get('dondatphong/processing/dondatphong', [DonDatPhongController::class,'findDDPprocess']);
Route::post('dondatphong', [DonDatPhongController::class,'store']);
Route::put('dondatphong/{id}', [DonDatPhongController::class,'update']);





Route::delete('ctddp/{id}', [CTDDPController::class,'destroy']);
Route::get('ctddp/{id}', [CTDDPController::class,'show']);
Route::get('ctddp/findbyMaDDP/{MaDDP}', [CTDDPController::class,'findbyMaDDP']);
Route::post('ctddp', [CTDDPController::class,'store']);
Route::put('ctddp/{id}', [CTDDPController::class,'update']);
Route::resource('ctddp', CTDDPController::class);






Route::post('image/hinhanhloaiphong/upload',[ImageLoaiPhongController::class, 'imageStore']);
Route::delete('hinhanhloaiphong/image/loaiphong/{src}', [ImageLoaiPhongController::class,'destroy']);
Route::get('hinhanhloaiphong/UIDLoaiPhong/{UIDLoaiPhong}', [ImageLoaiPhongController::class,'getImageByUIDLoaiPhong']);
Route::resource('hinhanhloaiphong', ImageLoaiPhongController::class);


Route::get('thanhpho/{id}', [ThanhPhoController::class,'show']);
Route::post('thanhpho/getbyname/{name}',[ThanhPhoController::class, 'getThanhPhoByName']);
Route::resource('thanhpho', ThanhPhoController::class);


Route::post('image/hinhanhtp/upload',[HinhAnhThanhPhoController::class, 'imageStore']);
Route::delete('hinhanhtp/image/thanhpho/{src}', [HinhAnhThanhPhoController::class,'destroy']);
Route::get('hinhanhtp/UIDThanhPho/{MaTP}', [HinhAnhThanhPhoController::class,'getImageByUIDThanhPho']);
Route::resource('hinhanhtp', HinhAnhThanhPhoController::class);


Route::get('diadiemdulich/{id}', [DiaDiemDuLichController::class,'show']);
Route::get('diadiemdulich/findbymatp/{id}', [DiaDiemDuLichController::class,'findbyMaTP']);
Route::resource('diadiemdulich', DiaDiemDuLichController::class);


Route::post('image/hinhanhdddl/upload',[HinhAnhDiaDiemDuLichController::class, 'imageStore']);
Route::delete('hinhanhdddl/image/diadiemdulich/{src}', [HinhAnhDiaDiemDuLichController::class,'destroy']);
Route::get('hinhanhdddl/UIDDDDL/{MaDDDL}', [HinhAnhDiaDiemDuLichController::class,'getImageByUIDDDDL']);
Route::resource('hinhanhdddl', HinhAnhDiaDiemDuLichController::class);





Route::get('sukien/{id}', [SuKienController::class,'show']);
Route::get('sukien/findbyMaDDL/{id}', [SuKienController::class,'findbyMaDDL']);
Route::post('sukien', [SuKienController::class,'store']);
Route::put('sukien/{id}', [SuKienController::class,'update']);
Route::resource('sukien', SuKienController::class);



Route::get('chukhachsan/{id}', [ChuKhachSanController::class,'show']);
Route::post('chukhachsan', [ChuKhachSanController::class,'store']);
Route::put('chukhachsan/{id}', [ChuKhachSanController::class,'update']);
Route::resource('chukhachsan', ChuKhachSanController::class);


Route::post('image/hinhanhSK/upload',[HinhAnhSuKienController::class, 'imageStore']);
Route::delete('hinhanhSK/image/SuKien/{src}', [HinhAnhSuKienController::class,'destroy']);
Route::get('hinhanhSK/UIDSK/{MaSuKien}', [HinhAnhSuKienController::class,'getImageByUIDMaSukien']);
Route::resource('hinhanhSK', HinhAnhSuKienController::class);

Route::get('phongconlai/{id}', [PhongConLaiController::class,'show']);
Route::post('phongconlai', [PhongConLaiController::class,'store']);
Route::put('phongconlai/{id}', [PhongConLaiController::class,'update']);
Route::resource('phongconlai', PhongConLaiController::class);






















