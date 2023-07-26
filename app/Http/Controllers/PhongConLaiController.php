<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use App\Models\Phongconlai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhongConLaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Phongconlai::all();
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

            'Ngay' => 'required|date_format:Y-m-d',
            'UIDLoaiPhong' => 'required',


        ]);

        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');

        $Ngay = $request->input("Ngay");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");

        if (!empty($Ngay)) {

            $phongconlai = new Phongconlai();
            $phongconlai->Ngay = $Ngay;
            $phongconlai->UIDLoaiPhong = $UIDLoaiPhong;
            $loaiphong = Loaiphong::findOrFail($UIDLoaiPhong);
            $phongconlai->SoLuong = $loaiphong->soLuongPhong;
            $phongconlai->save();
            return response($phongconlai, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Phongconlai::findOrFail($id);
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
        $phongconlai = Phongconlai::findOrFail($id);
        $this->validate($request, [
            'SoLuongPhongDat' => 'required',
        ]);
        $SoLuongPhongDat = intval($request->input("SoLuongPhongDat"));

        if (!empty($phongconlai)) {
            $phongconlai->SoLuong = $phongconlai->soLuong + $SoLuongPhongDat;
            $phongconlai->save();
            return response($phongconlai, Response::HTTP_CREATED);
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
    }

    public function BookingRoom(Request $request)
    {
        //
        $this->validate($request, [

            'Ngay' => 'required|date_format:Y-m-d',
            'UIDLoaiPhong' => 'required',
            'SoLuongPhong' => 'required'

        ]);


        $Ngay = $request->input("Ngay");

        $UIDLoaiPhong = $request->input("UIDLoaiPhong");
        $SoLuongPhong = $request->input("SoLuongPhong");
        $phongconlai = Phongconlai::where('Ngay', $Ngay)
            ->where('UIDLoaiPhong', $UIDLoaiPhong)
            ->get();


        if (empty($phongconlai[0])) {

            $phongconlai = new Phongconlai();
            $phongconlai->Ngay = $Ngay;
            $phongconlai->UIDLoaiPhong = $UIDLoaiPhong;
            $loaiphong = Loaiphong::findOrFail($UIDLoaiPhong);

            if ($loaiphong->soLuongPhong >= $SoLuongPhong) {
                $phongconlai->SoLuong = $loaiphong->soLuongPhong - $SoLuongPhong;
                return $phongconlai->save();
            } else {
                return response()->json(["message" => "eror"], 404);
            }
        } else {

            if ($phongconlai[0]->SoLuong >= $SoLuongPhong) {

                $phongconlai[0]->SoLuong = $phongconlai[0]->SoLuong - $SoLuongPhong;
                return $phongconlai[0]->update();
            } else {

                return response()->json(["message" => "eror"], 404);
            }
        }
    }

    public function CheckoutRoom(Request $request)
    {
        //
        $this->validate($request, [

            'Ngay' => 'required|date_format:Y-m-d',
            'UIDLoaiPhong' => 'required',
            'SoLuongPhong' => 'required'

        ]);


        $Ngay = $request->input("Ngay");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");
        $SoLuongPhong = $request->input("SoLuongPhong");
        $phongconlai = Phongconlai::where('Ngay', $Ngay)
            ->where('UIDLoaiPhong', $UIDLoaiPhong)
            ->get();
        $loaiphong = Loaiphong::findOrFail($UIDLoaiPhong);

        if (!empty($phongconlai) && !empty($loaiphong)) {
            $phongconlai[0]->SoLuong = $phongconlai[0]->SoLuong + $SoLuongPhong;
            if ($phongconlai[0]->SoLuong <= $loaiphong->soLuongPhong) {
                return $phongconlai[0]->update();
            } else {
                return response()->json(["message" => "eror"], 404);
            }
        } else {
            return response()->json(["message" => "eror"], 404);
        }
    }

    // public function GetDateRoom(Request $request)
    // {
    //     //
    //     $this->validate($request, [

    //         'Ngay' => 'required|date_format:Y-m-d',
    //         'UIDLoaiPhong' => 'required',

    //     ]);


    //     $Ngay = $request->input("Ngay");
    //     $UIDLoaiPhong = $request->input("UIDLoaiPhong");

    //     $phongconlai = Phongconlai::where('Ngay', $Ngay)
    //         ->where('UIDLoaiPhong', $UIDLoaiPhong)
    //         ->get();


    //     if (!empty($phongconlai)) {
    //         return $phongconlai[0];
    //     } else {
    //         return response()->json(["message" => "eror"], 404);
    //     }
    // }
    public function GetDateRoom(Request $request)
    {
        $this->validate($request, [
            'Ngay' => 'required|date_format:Y-m-d',
            'UIDLoaiPhong' => 'required',
        ]);

        $Ngay = $request->input("Ngay");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");


        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);
        $startDate =  $Date->copy()->addDays(1)->format('Y-m-d');

        $endDate =  $Date->copy()->addDays(15)->format('Y-m-d');
       
       
       
       

        $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
            ->where('UIDLoaiPhong', $UIDLoaiPhong)
            ->orderBy('Ngay', 'asc')
            ->get();


        return response()->json($phongconlai);
    }

    public function GetRoomDateNow(Request $request)
    {
        $this->validate($request, [
            'Ngay' => 'required|date_format:Y-m-d',
            'UIDLoaiPhong' => 'required',
        ]);

        $Ngay = $request->input("Ngay");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");


        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);
        $startDate =  $Date->addDays(0)->format('Y-m-d');

        $endDate =  $Date->addDays(14)->format('Y-m-d');
       
       
        
       

        $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
            ->where('UIDLoaiPhong', $UIDLoaiPhong)
            ->orderBy('SoLuong', 'asc')
            ->get();


        return response()->json($phongconlai);
    }

}
