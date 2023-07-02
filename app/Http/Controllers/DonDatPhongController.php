<?php

namespace App\Http\Controllers;

use App\Models\Ctddp;
use App\Models\Dondatphong;
use App\Models\Loaiphong;
use App\Models\Phongconlai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class DonDatPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dondatphong::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'UIDDatPhong' => 'required',
            'EmailKH' => 'required',
            'NgayDatPhong' => 'required|date_format:Y-m-d',
            'isChecked' => 'required',
            'TienCoc' => 'required',
            'tongtien' => 'required',


        ]);


        $UIDDatPhong = $request->input("UIDDatPhong");
        $EmailKH = $request->input("EmailKH");
        $NgayDatPhong = $request->input("NgayDatPhong");


        $TienCoc = $request->input("TienCoc");
        $tongtien = $request->input("tongtien");

        $isChecked = $request->input("isChecked");




        if (!empty($UIDDatPhong)) {

            $dondatphong = new Dondatphong();
            $dondatphong->UIDDatPhong = $UIDDatPhong;
            $dondatphong->EmailKH = $EmailKH;
            $dondatphong->NgayDatPhong = $NgayDatPhong;
            $dondatphong->TienCoc = $TienCoc;
            $dondatphong->tongtien = $tongtien;
            $dondatphong->isChecked = $isChecked;


            $dondatphong->save();



            return response($dondatphong, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    public function findDDPprocess()
    {
        return Dondatphong::whereNotIn('isChecked', [0, 5])->get();
    }

    public function findHistoryDDPByCKS(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        return Dondatphong::where('isChecked', 5)
            ->orWhereIn('isChecked', [6,7,8])
            ->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')
            ->get();
    }

    public function findHistoryDDPByKH(Request $request)
    {
        $this->validate($request, [
            'EmailKH' => 'required',
        ]);
        $EmailKH = $request->input("EmailKH");
        return Dondatphong::where('isChecked', 5)
            ->orWhereIn('isChecked', [6,7,8])
            ->where('EmailKH', $EmailKH)
            ->get();
    }



    public function lastItemByEmail(string $EmailKH)
    {
        $DonDatPhong = Dondatphong::where('EmailKH', $EmailKH)->get();
        return $DonDatPhong->last();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Dondatphong::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dondatphong = Dondatphong::findOrFail($id);
        $this->validate($request, [

            'EmailKH' => 'required',
            'NgayDatPhong' => 'required|date_format:Y-m-d',
            'isChecked' => 'required',
            'TienCoc' => 'required',
            'tongtien' => 'required',


        ]);

        $EmailKH = $request->input("EmailKH");
        $NgayDatPhong = $request->input("NgayDatPhong");
        $TienCoc = $request->input("TienCoc");
        $tongtien = $request->input("tongtien");
        $isChecked = $request->input("isChecked");
        if (!empty($dondatphong)) {
            $dondatphong->EmailKH = $EmailKH;
            $dondatphong->NgayDatPhong = $NgayDatPhong;
            $dondatphong->TienCoc = $TienCoc;
            $dondatphong->tongtien = $tongtien;
            $dondatphong->isChecked = $isChecked;
            return $dondatphong->update();
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return Dondatphong::destroy($id);
    }

    public function AcceptDonDatPhong(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;
        $ArrayMaxRoom = [];
        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);
        $startDate =  $Date->addDays(0)->format('Y-m-d');
        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);
            $MaxRoom = $loaiphong->soLuongPhong;
            $endDate =  $Date->copy()->addDays(intval($item->SoNgayO))->format('Y-m-d');
            $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
                ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                ->orderBy('SoLuong', 'asc')
                ->first();
            if (!empty($phongconlai)) {
                $ArrayMaxRoom[] = $phongconlai->SoLuong;
            } else {
                $ArrayMaxRoom[] = $MaxRoom;
            }
        }

        for ($i = 0; $i < count($chitietdondatphong); $i++) {
            if ($ArrayMaxRoom[$i] < $chitietdondatphong[$i]->soLuongPhong) {
                return response()->json(["message" => "eror"], 404);
            }
        }

        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (empty($phongconlai)) {
                    $phongconlai = new Phongconlai();
                    $phongconlai->Ngay = $NgayTam;
                    $phongconlai->UIDLoaiPhong = $item->UIDLoaiPhong;


                    if ($loaiphong->soLuongPhong >= $item->soLuongPhong) {
                        $phongconlai->SoLuong = $loaiphong->soLuongPhong - $item->soLuongPhong;

                        $phongconlai->save();
                    }
                } else {
                    if ($phongconlai->SoLuong >= $item->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong - $item->soLuongPhong;

                        $phongconlai->update();
                    }
                }
            }
        }
        $dondatphong->isChecked = 2;

        return response()->json($dondatphong->update());
    }

    public function CancelDonDatPhongByUser(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;

        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);

        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (!empty($phongconlai)) {
                    if ($phongconlai->SoLuong + $item->soLuongPhong <= $loaiphong->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong + $item->soLuongPhong;
                        $phongconlai->update();
                    } else {
                        return response()->json(["message" => "eror"], 404);
                    }
                } else {
                    return response()->json(["message" => "eror"], 404);
                }
            }
        }
        $dondatphong->isChecked = 6;

        return response()->json($dondatphong->update());
    }

    public function CancelDonDatPhongByChuKhachSan(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;

        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);

        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (!empty($phongconlai)) {
                    if ($phongconlai->SoLuong + $item->soLuongPhong <= $loaiphong->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong + $item->soLuongPhong;
                        $phongconlai->update();
                    } else {
                        return response()->json(["message" => "eror"], 404);
                    }
                } else {
                    return response()->json(["message" => "eror"], 404);
                }
            }
        }
        $dondatphong->isChecked = 7;
        $dondatphong->update();
        return response()->json($dondatphong);
    }
}
