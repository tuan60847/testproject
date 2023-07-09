<?php

namespace App\Http\Controllers;

use App\Models\Khachhang;
use App\Models\Khachsan;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function index()
    {
        $data = Khachhang::all();
        return view('khachhang.index', ['data' => $data]);
    }
    public function show(string $id)
    {
        $data = Khachhang::find($id);
        return view('khachhang.show', ['data' => $data]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'HoTen'=>'required',
            'SDT'=>'required',
            'Email'=>'required',
            'Password'=>'required',
        ]);
        $data = new Khachhang();
        $data->HoTen = $request->HoTen;
        $data->NgaySinh = $request->NgaySinh;
        $data->SDT = $request->SDT;
        $data->Email = $request->Email;
        $data->cmnd = $request->cmnd;
        $data->Password=sha1($request->Password);
        $data->save();

        $ref=$request->ref;
        if($ref=='front'){
            return redirect('register')->with('success','Đăng ký thành công!');
        }
    }
}
