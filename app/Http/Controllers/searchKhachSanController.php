<?php

namespace App\Http\Controllers;

use App\Models\Dondatphong;
use App\Models\Khachhang;
use App\Models\Loaiphong;
use Illuminate\Http\Request;

class searchKhachSanController extends Controller
{
    // public function search(Request $request)
    // {
    //     $this->validate($request, [
    //         'Search' => 'required',
    //     ]);
    //     $Search = $request->input("Search");
    //     $listSearch = [];
    //     $dondatphongs = Dondatphong::where('EmailKH', 'LIKE', '%' . $Search . '%')->get();
    //     $listSearch['dondatphongs'] = $dondatphongs;
    //     $loaiphongs = Loaiphong::Where('TenLoaiPhong', 'LIKE', '%' . $Search . '%')->get();
    //     $listSearch['loaiphongs'] = $loaiphongs;
    //     return view('searchKS', compact('dondatphongs', 'loaiphongs'));
    // }
    public function search(Request $request)
    {
        $this->validate($request, [
            'Search' => 'required',
            'UIDKS' => 'required',
        ]);

        $Search = $request->input("Search");
        $UIDKS = $request->input("UIDKS");

        $listSearch = [];
        $dondatphongs = Dondatphong::where('EmailKH', 'LIKE', '%' . $Search . '%')
            ->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')
            ->get();
        $listSearch['dondatphongs'] = $dondatphongs;

        $loaiphongs = Loaiphong::where('TenLoaiPhong', 'LIKE', '%' . $Search . '%')->where('isActive', '=', 1)->where('UIDKS', $UIDKS)->get();
        $listSearch['loaiphongs'] = $loaiphongs;

        return view('searchKS', compact('dondatphongs', 'loaiphongs'));
    }
}
