<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use App\Models\Phongconlai;
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
            return response()->json(["message"=>"eror"],404);
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
        
        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
       
        
        $SoLuongPhongDat = intval($request->input("SoLuongPhongDat"));

       
        
        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($phongconlai)) {
           
            $phongconlai->SoLuong = $phongconlai->soLuong+$SoLuongPhongDat;           
            $phongconlai->save();
            return response($phongconlai, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
