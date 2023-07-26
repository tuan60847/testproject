<?php

namespace App\Http\Controllers;

use App\Models\Ctddp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CTDDPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ctddp::all();
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

        $this->validate($request, [

            'MaDDP' => 'required',
            'UIDLoaiPhong' => 'required',
            'SoNgayO' => 'required',
            'soLuongPhong' => 'required',
            'Tien' => 'required',


        ]);

        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        $MaDDP = $request->input("MaDDP");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");
        $SoNgayO = $request->input("SoNgayO");

        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        $soLuongPhong = $request->input("soLuongPhong");
        $Tien = $request->input("Tien");


        // $isAdminKH ="isAdminKH";

        if (!empty($MaDDP)) {

            $cttdp = new Ctddp();
            $cttdp->MaDDP = $MaDDP;
            $cttdp->UIDLoaiPhong = $UIDLoaiPhong;
            $cttdp->SoNgayO = intval($SoNgayO);
            $cttdp->soLuongPhong = intval($soLuongPhong);
            $cttdp->Tien = floatval($Tien);
            $cttdp->save();



            return response($cttdp, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    public function findbyMaDDP(string $MaDDP)
    {
        return Ctddp::where('MaDDP', '=', $MaDDP)->get();
    }


    public function FindTonTaiCTTDDP(Request $request)
    {
        $this->validate($request, [
            'MaDDP' => 'required',
            'UIDLoaiPhong' => 'required',
        ]);

        $MaDDP = $request->input("MaDDP");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");



        $ctddp = Ctddp::where('MaDDP', $MaDDP)
            ->where('UIDLoaiPhong', $UIDLoaiPhong)
            ->first();

        if (!empty($ctddp)) {
            return response()->json($ctddp);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $MaDDP)
    {

        $ctddp = Ctddp::findOrFail($MaDDP);
        return $ctddp;
        // return view('dondatphong.show', ['ctddp' =>  $ctddp]);


        //return Ctddp::findOrFail($id);

    }

    public function showWeb(string $MaDDP)
    {

        $ctddp = Ctddp::findOrFail($MaDDP);
        return $ctddp;
        // return view('dondatphong.show', ['ctddp' =>  $ctddp]);


        //return Ctddp::findOrFail($id);

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
        $cttdp = Ctddp::findOrFail($id);
        $this->validate($request, [

            'MaDDP' => 'required',
            'UIDLoaiPhong' => 'required',
            'SoNgayO' => 'required',
            'soLuongPhong' => 'required',
            'Tien' => 'required',


        ]);

        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        $MaDDP = $request->input("MaDDP");
        $UIDLoaiPhong = $request->input("UIDLoaiPhong");
        $SoNgayO = $request->input("SoNgayO");

        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        $soLuongPhong = $request->input("soLuongPhong");
        $Tien = $request->input("Tien");


        // $isAdminKH ="isAdminKH";

        if (!empty($MaDDP)) {


            $cttdp->MaDDP = $MaDDP;
            $cttdp->UIDLoaiPhong = $UIDLoaiPhong;
            $cttdp->SoNgayO = intval($SoNgayO);
            $cttdp->soLuongPhong = intval($soLuongPhong);
            $cttdp->Tien = floatval($Tien);


            return $cttdp->update();
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
        return Ctddp::destroy($id);
    }
    public function Chitietdondat(String $id)
    {

        $ctddp = Ctddp::where('MaDDP', $id)->fisrt();
        session(['dondat' => $ctddp]);
    }
}
