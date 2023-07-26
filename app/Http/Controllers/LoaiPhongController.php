<?php

namespace App\Http\Controllers;

use App\Models\Loaiphong;
use App\Models\Phongconlai;
use App\Models\Chukhachsan;
use App\Models\Hinhanhloaiphong;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class LoaiPhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$loaiphongs = Loaiphong::where('isActive', '!=', 0)->get();
        // $responseData = [];
        // foreach ($loaiphongs as $loaiphong) {
        //     $responseData[] = [
        //         'UIDKS' => $loaiphong->UIDKS,
        //         'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
        //         'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
        //         'Gia' => $loaiphong->Gia,
        //         'soGiuong' => $loaiphong->soGiuong,
        //         'soLuongPhong' => $loaiphong->soLuongPhong,
        //         'isMayLanh' => boolval($loaiphong->isMayLanh),

        //     ];
        //     // return redirect('admin/loaiphong/findby/' . $loaiphong->UIDKS);
        // $loaiphong = Loaiphong::all();
        //  return view('loaiphong.index', ['loaiphong' => $loaiphongs]);
        //  }

        // return response()->json($responseData);
    }
    // public function indexWeb()
    // {
    //     $data = Loaiphong::all();
    //     return view('loaiphong.index', ['data' => $data]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Loaiphong $loaiphong)
    {
        return view('loaiphong.create', ['loaiphong' => $loaiphong]);
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

            //     $loaiphong = new Loaiphong();
            //     $loaiphong->TenLoaiPhong = $TenLoaiPhong;
            //     $loaiphong->Gia = floatval($Gia);
            //     $loaiphong->UIDKS = $UIDKS;
            //     $loaiphong->soGiuong = $soGiuong;

            //     $loaiphong->soLuongPhong = intval($soLuongPhong);
            //     $loaiphong->isMayLanh = $isMayLanh;
            //     // $loaiphong->phongConLai = intval($soLuongPhong);

            //     $loaiphong->save();

            //     return response($loaiphong, Response::HTTP_CREATED);
            // } else {
            //     // handle the case where the image upload fails
            //     // e.g. return an error response or redirect back to the form with an error message
            //     return response()->json(["message" => "eror"], 404);
            // }
            $loaiphong = new Loaiphong();
            $loaiphong->TenLoaiPhong = $request->TenLoaiPhong;
            $loaiphong->Gia = $request->Gia;
            $loaiphong->UIDKS = $request->UIDKS;
            $loaiphong->soGiuong = $request->soGiuong;
            $loaiphong->soLuongPhong = $request->soLuongPhong;
            $loaiphong->isMayLanh = $request->isMayLanh;
            $loaiphong->save();
            foreach ($request->file('imgs') as $img) {
                $imgPath = $img->store('public/imgs');
                $imgData = new Hinhanhloaiphong;
                $imgData->UIDLoaiPhong = $loaiphong->UIDLoaiPhong;
                $imgData->src = $imgPath;
                $imgData->save();
            }
            return redirect('adminKS/loaiphong/findbyKS/' . $loaiphong->UIDKS . '/create')->with('success', 'Thêm thành công');
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
    }

    /**
     * Display the specified resource.
     */

    public function findlast(string $UIDKS)
    {
        //
        $loaiphongs = Loaiphong::where('UIDKS', $UIDKS)->where('isActive', '!=', 0)->get();
        $loaiphong = $loaiphongs->last();
        $responseData = [
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
        // $loaiphong = Loaiphong::findOrFail($id);
        // $responseData = [
        //     'UIDKS' => $loaiphong->UIDKS,
        //     'UIDLoaiPhong' => $loaiphong->UIDLoaiPhong,
        //     'TenLoaiPhong' => $loaiphong->TenLoaiPhong,
        //     'Gia' => $loaiphong->Gia,
        //     'soGiuong' => $loaiphong->soGiuong,
        //     'soLuongPhong' => $loaiphong->soLuongPhong,
        //     'isMayLanh' => boolval($loaiphong->isMayLanh),
        // ];
        //return response()->json($responseData);
        $loaiphong = Loaiphong::find($id);
        return view('loaiphong.show', ['loaiphong' => $loaiphong]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loaiphong = Loaiphong::find($id);
        return view('loaiphong.edit', ['loaiphong' => $loaiphong]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function getloaiphongbyks(string $id)
    {
        $loaiphongs = Loaiphong::where('UIDKS', $id)->where('isActive', '!=', 0)->get();
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

            // return response()->json($responseData);
        }
        // return redirect('admin/loaiphong/findby/' . $loaiphongs->UIDKS);
        // if ($loaiphong->UIDKS == $data->ADMINKS) {
        //     $loaiphong = Loaiphong::find($id);
        //     return view('loaiphong.index', ['loaiphong' => $loaiphong]);
        // }
        return view('loaiphong.index', ['loaiphong' => $loaiphongs]);
        // return redirect('adminKS/loaiphong/findbyKS/' . $loaiphong->UIDKS);

    }
    public function update(Request $request, string $id)
    {
        $loaiphong = Loaiphong::find($id);
        $this->validate($request, [

            'TenLoaiPhong' => 'required',
            'Gia' => 'required',
            // 'UIDKS' => 'required',
            'soGiuong' => 'required',
            'soLuongPhong' => 'required',
            'isMayLanh' => 'required',
        ]);



        // $TenLoaiPhong = $request->input("TenLoaiPhong");
        // $UIDKS = $request->input("UIDKS");
        // $Gia = $request->input("Gia");


        // $soGiuong = $request->input("soGiuong");
        // $soLuongPhong = $request->input("soLuongPhong");
        // $isMayLanh = $request->input("isMayLanh") == false || $request->input("isMayLanh") == "false" || $request->input("isMayLanh") == null ? false : true;



        // if (!empty($loaiphong)) {


        //     $loaiphong->TenLoaiPhong = $TenLoaiPhong;
        //     $loaiphong->Gia = floatval($Gia);
        //     $loaiphong->UIDKS = $UIDKS;
        //     $loaiphong->soGiuong = $soGiuong;
        //     $number = $loaiphong->soLuongPhong - intval($soLuongPhong);
        //     $loaiphong->soLuongPhong = intval($soLuongPhong);
        //     $loaiphong->isMayLanh = $isMayLanh;
        //     $currentDate = Carbon::now();
        //     $currentDate->format('Y-m-d');

        //     $phongConLais = Phongconlai::where('UIDLoaiPhong', $loaiphong->UIDLoaiPhong)->whereDate('Ngay', '>', $currentDate)
        //         ->get();
        //     foreach ($phongConLais as $phongConLai) {
        //         $phongConLai->SoLuong -= $number;
        //         $phongConLai->update();
        //     }



        //     return $loaiphong->update();
        // } else {
        //     // handle the case where the image upload fails
        //     // e.g. return an error response or redirect back to the form with an error message
        //     return response()->json(["message" => "eror"], 404);
        // }
        $loaiphong = Loaiphong::find($id);
        $loaiphong->TenLoaiPhong = $request->TenLoaiPhong;
        $loaiphong->Gia = $request->Gia;
        // $loaiphong->UIDKS = $request->UIDKS;
        $loaiphong->soGiuong = $request->soGiuong;
        $loaiphong->soLuongPhong = $request->soLuongPhong;
        $loaiphong->isMayLanh = $request->isMayLanh;
        $loaiphong->save();

        if ($request->hasFile('imgs')) {
            foreach ($request->files('imgs') as $img) {
                $imgPath = $img->store('public/imgs');
                $imgData = new Hinhanhloaiphong();
                $imgData->maSuKien = $loaiphong->UIDLoaiPhong;
                $imgData->src = $imgPath;
                $imgData->save();
            }
        }
        return redirect('adminKS/loaiphong/findbyKS/' . $id . '/edit')->with('success', 'Loại phòng đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $UIDKS)
    {
        // $loaiphong = Loaiphong::findOrFail($id);
        // if (!empty($loaiphong)) {
        //     $loaiphong->isActive = 0;
        //     return $loaiphong->update();
        // } else {
        //     return response()->json(["message" => "error"], 404);
        // }
        // $loaiphongs = Loaiphong::where('UIDKS', $id)->where('isActive', '!=', 0)->get();
        Loaiphong::where('UIDLoaiPhong', $id)->delete();
        //   return redirect('adminKS/loaiphong/findbyKS/' . $UIDKS)->with('success', 'Loại phòng đã được xóa');
        return redirect()->route('adminKS.loaiphong.findbyKS', $UIDKS, $id)->with('success', 'Loại phòng đã được xóa');
    }
    public function destroy_image($img_id)
    {
        $loaiphong = Hinhanhloaiphong::where('UIDLoaiPhong', $img_id)->first();
        Storage::delete($loaiphong->src);

        Hinhanhloaiphong::where('UIDLoaiPhong', $img_id)->delete();
        return response()->json(['bool' => true]);
    }
}
