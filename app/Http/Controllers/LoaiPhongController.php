<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoaiPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $loaiphongs = Loaiphong::all();
        $responseData = [];
        foreach ($loaiphongs as $loaiphong) {
            $responseData[] = [
                'UIDKS' => $loaiphong->UIDKS,
                'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
                'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
                'Gia' => $loaiphong->Gia,
                'soGiuong' => $loaiphong->soGiuong,
                'soLuongPhong' => $loaiphong->soLuongPhong,
                'isMayLanh' => boolval($loaiphong->isMayLanh),


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

            'TenLoaiPhong' => 'required',
            'Gia' => 'required',
            'UIDKS' => 'required',
            'soGiuong' => 'required',
            'soLuongPhong' => 'required',
            'isMayLanh' => 'required',


        ]);

        

        $TenLoaiPhong = $request->input("TenLoaiPhong");
        $UIDKS = $request->input("UIDKS");
        $Gia = $request->input("Gia");

        
        $soGiuong = $request->input("soGiuong");
        $soLuongPhong = $request->input("soLuongPhong");
        $isMayLanh = $request->input("isMayLanh") == false || $request->input("isMayLanh") == null ? false : true;




        if (!empty($TenLoaiPhong)) {

            $loaiphong = new Loaiphong();
            $loaiphong->TenLoaiPhong = $TenLoaiPhong;
            $loaiphong->Gia = floatval($Gia);
            $loaiphong->UIDKS = $UIDKS;
            $loaiphong->soGiuong = $soGiuong;

            $loaiphong->soLuongPhong = intval($soLuongPhong);
            $loaiphong->isMayLanh = $isMayLanh;
            // $loaiphong->phongConLai = intval($soLuongPhong);

            $loaiphong->save();

            return response($loaiphong, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    // public function UpdateSLLoaiPhong(Request $request, string $UIDLoaiPhong)
    // {
    //     //
    //     $loaiphong = Loaiphong::where('UIDLoaiPhong', $UIDLoaiPhong)->get();
    //     $this->validate($request, [        
    //         'phongConLai' => 'required',  
    //     ]);
    //     $phongConLai =$request->input("phongConLai");
    //     if (!empty($loaiphong)) {

    //         $loaiphong->phongConLai+=$phongConLai;
    //         if($loaiphong->phongConLai>0&&$loaiphong->phongConLai<$loaiphong->soLuongPhong){
    //             return $loaiphong->save();  
    //         }else{
    //             return response()->json(["message"=>"eror"],404);
    //         }      
    //     } else {
    //         // handle the case where the image upload fails
    //         // e.g. return an error response or redirect back to the form with an error message
    //         return response()->json(["message"=>"eror"],404);
    //     }
    // }

    /**
     * Display the specified resource.
     */

    public function findlast(string $UIDKS)
    {
        //
        $loaiphongs = Loaiphong::where('UIDKS', $UIDKS)->get();
        $loaiphong= $loaiphongs->last();
        $responseData[] = [
            'UIDKS' => $loaiphong->UIDKS,
            'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
            'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
            'Gia' => $loaiphong->Gia,
            'soGiuong' => $loaiphong->soGiuong,
            'soLuongPhong' => $loaiphong->soLuongPhong,
            'isMayLanh' => boolval($loaiphong->isMayLanh),


        ];
        return response()->json($responseData);
    }


    public function show(string $id)
    {
        //
        $loaiphong= Loaiphong::findOrFail($id);
        $responseData[] = [
            'UIDKS' => $loaiphong->UIDKS,
            'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
            'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
            'Gia' => $loaiphong->Gia,
            'soGiuong' => $loaiphong->soGiuong,
            'soLuongPhong' => $loaiphong->soLuongPhong,
            'isMayLanh' => boolval($loaiphong->isMayLanh),


        ];
        return response()->json($responseData);
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
    public function getloaiphongbyks(string $id)
    {
        $loaiphongs = Loaiphong::where('UIDKS', $id)->get();
        $responseData = [];
        foreach ($loaiphongs as $loaiphong) {
            $responseData[] = [
                'UIDKS' => $loaiphong->UIDKS,
                'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
                'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
                'Gia' => $loaiphong->Gia,
                'soGiuong' => $loaiphong->soGiuong,
                'soLuongPhong' => $loaiphong->soLuongPhong,
                'isMayLanh' => boolval($loaiphong->isMayLanh),


            ];
        }

        return response()->json($responseData);
    }




    public function update(Request $request, string $id)
    {
        $loaiphong = Loaiphong::findOrFail($id);
        $this->validate($request, [

            'TenLoaiPhong' => 'required',
            'Gia' => 'required',
            'UIDKS' => 'required',
            'soGiuong' => 'required',
            'soLuongPhong' => 'required',
            'isMayLanh' => 'required',


        ]);

        

        $TenLoaiPhong = $request->input("TenLoaiPhong");
        $UIDKS = $request->input("UIDKS");
        $Gia = $request->input("Gia");

        
        $soGiuong = $request->input("soGiuong");
        $soLuongPhong = $request->input("soLuongPhong");
        $isMayLanh = $request->input("isMayLanh") == false || $request->input("isMayLanh") == null ? false : true;
        // $phongConLai = $request->input("phongConLai");



        if (!empty($loaiphong) && empty($phongConLai)) {

            // $loaiphong->UIDLoaiPhong = $UIDLoaiPhong;
            $loaiphong->TenLoaiPhong = $TenLoaiPhong;
            $loaiphong->Gia = floatval($Gia);
            $loaiphong->UIDKS = $UIDKS;
            $loaiphong->soGiuong = $soGiuong;
            // if($loaiphong->soLuongPhong <= intval($soLuongPhong)){
            //     $loaiphong->phongConLai += (intval($soLuongPhong)-$loaiphong->soLuongPhong);

            // }else{
            //     if($loaiphong->phongConLai>=intval($soLuongPhong)){
            //         $loaiphong->phongConLai=intval($soLuongPhong);
            //     }
            // }
            $loaiphong->soLuongPhong = intval($soLuongPhong);
            $loaiphong->isMayLanh = $isMayLanh;



            return $loaiphong->update();
        } else if (!empty($loaiphong) && !empty($phongConLai)) {
            $loaiphong->TenLoaiPhong = $TenLoaiPhong;
            $loaiphong->Gia = floatval($Gia);
            $loaiphong->UIDKS = $UIDKS;
            $loaiphong->soGiuong = $soGiuong;

            // if($loaiphong->soLuongPhong < intval($soLuongPhong)){
            //     $loaiphong->phongConLai = (intval($soLuongPhong)-$loaiphong->soLuongPhong)+ $loaiphong->phongConLai ;

            // }else{
            //     if($loaiphong->soLuongPhong>intval($soLuongPhong)){
            //         $loaiphong->phongConLai=intval($soLuongPhong);
            //     }else{
            //         $loaiphong->phongConLai = intval($phongConLai);
            //     }
            // }

            $loaiphong->soLuongPhong = intval($soLuongPhong);


            $loaiphong->isMayLanh = $isMayLanh;
            return $loaiphong->update();
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
        return Loaiphong::destroy($id);
    }
}
