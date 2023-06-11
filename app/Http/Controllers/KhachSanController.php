<?php

namespace App\Http\Controllers;

use App\Models\Khachsan;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class KhachSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('khachsan.hotel');

        $Khachsans = Khachsan::all();

    $responseData = [];
    foreach ($Khachsans as $Khachsan) {
        $responseData[] = [
            'UIDKS' => $Khachsan->UIDKS,
            'TenKS' => $Khachsan->TenKS,
            'DiaChi' => $Khachsan->DiaChi,
            'SDT' => $Khachsan->SDT,
            'MaDDDL' => $Khachsan->MaDDDL,
            'Wifi' => boolval($Khachsan->Wifi),
            'Buffet' => boolval($Khachsan->Buffet),
            'isActive' => boolval($Khachsan->isActive),
            
        ];
    }

    return response()->json($responseData);
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
            'UIDKS' => 'required',
            'TenKS' => 'required',
            'DiaChi' => 'required',
            'SDT' => 'required',
            'MaDDDL' =>'required',
            
            
            
        ]);
        
        // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        $UIDKS = $request->input("UIDKS");
        $TenKS = $request->input("TenKS");
        $DiaChi =$request->input("DiaChi");

        // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        $SDT = $request->input("SDT");
        $MaDDDL=$request->input("MaDDDL");
        $isActive=$request->input("isActive")=="false"||$request->input("isActive")==null?false:true;
        $Buffet=$request->input("Buffet")=="false"||$request->input("Buffet")==null?false:true;
        $wifi=$request->input("Wifi")=="false"||$request->input("Wifi")==null?false:true;
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($UIDKS)) {
           
            $khachsan = new Khachsan();
            $khachsan->UIDKS = $UIDKS;
            $khachsan->TenKS = $TenKS;
            $khachsan->DiaChi = $DiaChi;
            $khachsan->SDT = $SDT;     
            $khachsan->isActive=$isActive;
            $khachsan->Buffet=$Buffet;
            $khachsan->Wifi=$wifi;
            $khachsan->MaDDDL=$MaDDDL;
            $khachsan->save();
        
            
           
            return response($khachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
        Khachsan::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Khachsan::findOrFail($id);

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
        
        $khachsan =  Khachsan::findOrFail($id);
       
        $this->validate($request, [
            'TenKS' => 'required',
            'DiaChi' => 'required',
            'SDT' => 'required',
            'isActive' => 'required',
            'MaDDDL' =>'required',
            
        ]);
        
        
        $TenKS = $request->input("TenKS");   
        $DiaChi =$request->input("DiaChi");
        $SDT = $request->input("SDT");
        $MaDDDL=$request->input("MaDDDL");
        $isActive=$request->input("isActive")=="false"||$request->input("isActive")==null?false:true;
        $buffet=$request->input("Buffet")=="false"||$request->input("Buffet")==null?false:true;
        $Wifi=$request->input("Wifi")=="false"||$request->input("Wifi")==null?false:true;
        
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($khachsan)) {
           
            // $khachsan = new Khachsan();
            
            $khachsan->TenKS = $TenKS;
            
            $khachsan->DiaChi = $DiaChi;
            $khachsan->SDT = $SDT;
           
            $khachsan->isActive=$isActive;
            $khachsan->Buffet=$buffet;
            $khachsan->Wifi=$Wifi;
            $khachsan->MaDDDL=$MaDDDL;
            return $khachsan->update();
        
            
           
            // return response($khachsan, Response::HTTP_CREATED);
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
        return Khachsan::destroy($id);
    }
}
