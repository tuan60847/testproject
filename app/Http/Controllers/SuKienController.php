<?php

namespace App\Http\Controllers;

use App\Models\Sukien;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuKienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Sukien::all();
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
           
            'TenSuKien' => 'required',
            'Mota' => 'required',
            'NgayBatDau' => 'required|date_format:Y-m-d',
            'MaDDDL' => 'required',
            
            
        ]);
        
        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
       
        $TenSuKien = $request->input("TenSuKien");
        $Mota = $request->input("Mota");
        $NgayBatDau =$request->input("NgayBatDau");
        $NgayKetThuc =$request->input("NgayKetThuc");
        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        
        
        $MaDDDL = $request->input("MaDDDL");
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($TenSuKien)) {
           
            $sukien = new Sukien();
            $sukien->TenSuKien = $TenSuKien;
            $sukien->Mota = $Mota;
            $sukien->NgayBatDau = $NgayBatDau;
            $sukien->NgayKetThuc = $NgayKetThuc;
            $sukien->MaDDDL = $MaDDDL;
            
            
            
            
            
            $sukien->save();
            
            
           
            return response($sukien, Response::HTTP_CREATED);
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
        return Sukien::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function findbyMaDDL(string $id)
    {
        //
        return Sukien::where('MaDDDL', '=', $id)->orderByDesc('maSuKien')->get();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         //
         $sukien = Sukien::findOrFail($id);
         $this->validate($request, [
           
            'TenSuKien' => 'required',
            'Mota' => 'required',
            'NgayBatDau' => 'required|date_format:Y-m-d',
            'MaDDDL' => 'MaDDDL',
            
            
        ]);
        
        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
       
        $TenSuKien = $request->input("TenSuKien");
        $Mota = $request->input("Mota");
        $NgayBatDau =$request->input("NgayBatDau");
        $NgayKetThuc =$request->input("NgayKetThuc");
        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        
        
        $MaDDDL = $request->input("MaDDDL");
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($sukien)) {
           
            
            $sukien->TenSuKien = $TenSuKien;
            $sukien->Mota = $Mota;
            $sukien->NgayBatDau = $NgayBatDau;
            $sukien->NgayKetThuc = $NgayKetThuc;
            $sukien->MaDDDL = $MaDDDL;
             
           
            return $sukien->update();
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
        $sukien= Sukien::findOrFail($id);
        return $sukien->delete();
    }
}
