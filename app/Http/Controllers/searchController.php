<?php

namespace App\Http\Controllers;

use App\Models\Diadiemdulich;
use App\Models\Khachsan;
use App\Models\Thanhpho;
use Illuminate\Http\Request;

class searchController extends Controller
{
    //
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

        // $isAdminKH ="isAdminKH";

        if (!empty($listSearch)) {

            return $listSearch;

            // return response($khachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }
}
