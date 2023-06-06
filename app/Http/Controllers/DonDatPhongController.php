<?php

namespace App\Http\Controllers;

use App\Models\Dondatphong;
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
        $NgayDatPhong =$request->input("NgayDatPhong");

        
        $TienCoc = $request->input("TienCoc");
        $tongtien =$request->input("tongtien");
        
        $isChecked=$request->input("isChecked");
        
        
        
        
        if (!empty($UIDDatPhong)) {
           
            $dondatphong = new Dondatphong();
            $dondatphong->UIDDatPhong = $UIDDatPhong;
            $dondatphong->EmailKH = $EmailKH;
            $dondatphong->NgayDatPhong = $NgayDatPhong;
            $dondatphong->TienCoc = $TienCoc;
            $dondatphong->tongtien = $tongtien;
            $dondatphong->isChecked= $isChecked;
           
            
            $dondatphong->save();
            
            
           
            return response($dondatphong, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
    }

    public function findDDPprocess(){
        return Dondatphong::whereNotIn('isChecked', [0, 5])->get();

    }
   

    public function lastItemByEmail(string $EmailKH){
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
        $dondatphong= Dondatphong::findOrFail($id);
        $this->validate($request, [
            
            'EmailKH' => 'required',
            'NgayDatPhong' => 'required|date_format:Y-m-d',
            'isChecked' => 'required',
            'TienCoc' => 'required',
            'tongtien' => 'required',
            
            
        ]);
        
       
        
        $EmailKH = $request->input("EmailKH");
        $NgayDatPhong =$request->input("NgayDatPhong");

        
        $TienCoc = $request->input("TienCoc");
        $tongtien =$request->input("tongtien");
        
        $isChecked=$request->input("isChecked");
        
        
       
        
        if (!empty($dondatphong)) {
            
            $dondatphong->EmailKH = $EmailKH;
            $dondatphong->NgayDatPhong = $NgayDatPhong;
            $dondatphong->TienCoc = $TienCoc;
            $dondatphong->tongtien = $tongtien;
            $dondatphong->isChecked= $isChecked;
            
           
            return $dondatphong->update();
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
        return Dondatphong::destroy($id);
    }
}
