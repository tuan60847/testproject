<?php

namespace App\Http\Controllers;

use App\Models\Diadiemdulich;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class DiaDiemDuLichController extends Controller
{
    public function index()
    {
        $data= Diadiemdulich::all();
        return view('diadiemdulich.tourist',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diadiemdulich.createDDDL');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
            
        //     'TenDiaDiemDuLich' => 'required',
        //     'MoTa' => 'required',
        //     'MaTP' => 'required',
        //     'DiaChi' => 'required',
            
            
        // ]);
        
        // // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        // $TenDiaDiemDuLich = $request->input("TenDiaDiemDuLich");
        // $MoTa = $request->input("MoTa");
        // $ThoiGianHoatDong =$request->input("ThoiGianHoatDong");
        // $DiaChi =$request->input("DiaChi");
        // // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        // $GiaTien = $request->input("GiaTien");
        // $MaTP =$request->input("MaTP");
        
        
        // // $isAdminKH ="isAdminKH";
        
        // if (!empty($TenDiaDiemDuLich)) {
           
        //     $diadiemdulich = new Diadiemdulich();
            
        //     $diadiemdulich->TenDiaDiemDuLich = $TenDiaDiemDuLich;
        //     $diadiemdulich->MoTa = $MoTa;
        //     $diadiemdulich->ThoiGianHoatDong = $ThoiGianHoatDong;
        //     $diadiemdulich->GiaTien = $GiaTien;
        //     $diadiemdulich->MaTP= $MaTP;
            
           
            
        //     $diadiemdulich->save();
            
            
           
        //     return response($diadiemdulich, Response::HTTP_CREATED);
        // } else {
        //     // handle the case where the image upload fails
        //     // e.g. return an error response or redirect back to the form with an error message
        //     return response()->json(["message"=>"eror"],404);
        // }
        $data =new Diadiemdulich();
        $data->TenDiaDiemDuLich=$request->DiaDiemDuLich;
        $data->DiaChi=$request->DiaChi;
        $data->MoTa=$request->MoTa;
        $data->GiaTien=$request->GiaTien;
        $data->MaTP=$request->MaTP;
        $data->ThoiGianHoatDong=$request->ThoiGianHoatDong;
        $data->save();
        return redirect('createDDDl')->with('success','data has been');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Diadiemdulich::findOrFail($id);
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
        $this->validate($request, [
            
            'TenDiaDiemDuLich' => 'required',
            'MoTa' => 'required',
            'MaTP' => 'required',
            'DiaChi' => 'required',
            
            
        ]);
        
        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        $TenDiaDiemDuLich = $request->input("TenDiaDiemDuLich");
        $MoTa = $request->input("MoTa");
        $ThoiGianHoatDong =$request->input("ThoiGianHoatDong");
        $DiaChi =$request->input("DiaChi");
        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        $GiaTien = $request->input("GiaTien");
        $MaTP =$request->input("MaTP");
        
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($TenDiaDiemDuLich)) {
           
            $diadiemdulich = new Diadiemdulich();
            
            $diadiemdulich->TenDiaDiemDuLich = $TenDiaDiemDuLich;
            $diadiemdulich->MoTa = $MoTa;
            $diadiemdulich->ThoiGianHoatDong = $ThoiGianHoatDong;
            $diadiemdulich->GiaTien = $GiaTien;
            $diadiemdulich->MaTP= $MaTP;
            $diadiemdulich->DiaChi=$DiaChi;
           
            
            $diadiemdulich->save();
            
            
           
            return response($diadiemdulich, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
    }

    public function findbyMaTP(string $MaTP){
        return Diadiemdulich::where('MaTP', '=', $MaTP)->get();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
