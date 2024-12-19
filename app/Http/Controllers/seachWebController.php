<?php

namespace App\Http\Controllers;

use App\Models\Chukhachsan;
use App\Models\Diadiemdulich;
use App\Models\Khachhang;
use App\Models\Khachsan;
use App\Models\Sukien;
use App\Models\Thanhpho;
use Illuminate\Http\Request;

class seachWebController extends Controller
{
    public function TimKiem(Request $request)
    {
        //

        $this->validate($request, [
            'Search' => 'required',
        ]);


        $Search = $request->input("Search");
        $listSearch = [];
        $khachSans = Khachsan::where('TenKS', 'LIKE', '%' . $Search . '%')
            ->orWhere('DiaChi', 'LIKE', '%' . $Search . '%')
            ->where('isActive', true)
            ->get();

        $listSearch['khachsan'] = $khachSans;

        $thanhphos = Thanhpho::where('TenTP', 'LIKE', '%' . $Search . '%')->get();
        $listSearch['thanhpho'] = $thanhphos;

        $diadiemdulichs = Diadiemdulich::where('TenDiaDiemDuLich', 'LIKE', '%' . $Search . '%')
            ->orWhere('DiaChi', 'LIKE', '%' . $Search . '%')
            ->get();

        $listSearch['diadiemdulich'] = $diadiemdulichs;

        $chukhachsans = Chukhachsan::where('HoTen', 'LIKE', '%' . $Search . '%')
            ->orWhere('cmnd', $Search)
            ->get();
        $listSearch['chukhachsan'] = $chukhachsans;

        $khachhangs = Khachhang::where('HoTen', 'LIKE', '%' . $Search . '%')
            ->orWhere('cmnd', $Search)
            ->get();
        $listSearch['khachhang'] = $khachhangs;
        // $isAdminKH ="isAdminKH";
        $sukiens = Sukien::where('TenSuKien', 'LIKE', '%' . $Search . '%')->get();
        $listSearch['sukien'] = $sukiens;
        if (!empty($listSearch)) {
            return view('search', compact('khachSans', 'thanhphos', 'diadiemdulichs', 'chukhachsans', 'khachhangs', 'sukiens'));
            // return $listSearch;

            // return response($khachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }
}
