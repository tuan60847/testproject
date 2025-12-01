<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Chukhachsan;
use App\Models\Dondatphong;
use App\Models\Thanhpho;
use Carbon\Carbon;

class AdminController extends Controller
{
    function login()
    {
        return view('login');
    }
    function check_login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where(['username' => $request->username, 'password' => sha1($request->password)])->count();

        if ($admin > 0) {
            $adminData = Admin::where(['username' => $request->username, 'password' => sha1($request->password)])->get();
            session(['adminData' => $adminData]);
        } else {
            return redirect('admin/login')->with('msg', 'Invalid username/Password!!');
        }
    }

    function logout()
    {
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    function dashboard()
    {
        $bookings = Dondatphong::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();
        $labels = [];
        $data = [];
        foreach ($bookings as $booking) {
            $labels[] = $booking['checkin_date'];
            $data[] = $booking['total_bookings'];
        }


        return view('deshbord', ['labels' => $labels, 'data' => $data]);
    }
    public function index(string $UIDDatPhong)
    {
        $currentDate = Carbon::now();
        $getThang = $currentDate->month;
        $getYear = $currentDate->year;
        $getDay = $currentDate->day;
        // return $getThang;

        $sumTongTien = Dondatphong::where('UIDDatPhong', 'LIKE', '%' . $UIDDatPhong . '%')->where('isChecked', 5)->sum('tongtien');
        $sumThang = Dondatphong::whereYear('NgayDatPhong', '=', $getYear)->whereMonth('NgayDatPhong', '=', $getThang)->where('UIDDatPhong', 'LIKE', '%' . $UIDDatPhong . '%')->where('isChecked', 5)->sum('tongtien');
        $sumDay = Dondatphong::whereYear('NgayDatPhong', '=', $getYear)->whereMonth('NgayDatPhong', '=', $getThang)->whereDay('NgayDatPhong', '=', $getDay)->where('UIDDatPhong', 'LIKE', '%' . $UIDDatPhong . '%')->where('isChecked', 5)->sum('tongtien');

        return view('deshbord', compact('sumTongTien', 'sumThang', 'sumDay'));
    }

    public function hethong()
    {
        $currentDate = Carbon::now();
        $getThang = $currentDate->month;
        $getYear = $currentDate->year;
        $getDay = $currentDate->day;

        $dsDondatphongChecked5 = Dondatphong::where('isChecked', 5)->get();
        $sumTongTien = Dondatphong::where('isChecked', 5)->sum('tongtien');

        $tongNam = 0;
        $tongThang = 0;
        $tongNgay = 0;

        foreach ($dsDondatphongChecked5 as $dondatphong) {
            $giamGia = $dondatphong->tongtien * 0.1;
            $tongNam += $giamGia;

            if ($dondatphong->NgayDatPhong === $getYear) {
                $tongThang += $giamGia;
                if ($dondatphong->NgayDatPhong === $getThang) {
                    $tongNgay += $giamGia;
                }
            }
        }

        return view('home', compact('tongNam', 'tongThang', 'tongNgay'));
    }
}
