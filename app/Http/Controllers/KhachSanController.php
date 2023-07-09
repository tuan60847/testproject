<?php

namespace App\Http\Controllers;

use App\Models\Hinhanhk;
use App\Models\Khachsan;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use DB;

class KhachSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Khachsan::all();
        return view('khachsan.index', ['data' => $data]);

        // $responseData = [];
        // foreach ($Khachsans as $Khachsan) {
        //     $responseData[] = [
        //         'UIDKS' => $Khachsan->UIDKS,
        //         'TenKS' => $Khachsan->TenKS,
        //         'DiaChi' => $Khachsan->DiaChi,
        //         'SDT' => $Khachsan->SDT,
        //         'MaDDDL' => $Khachsan->MaDDDL,
        //         'Wifi' => boolval($Khachsan->Wifi),
        //         'Buffet' => boolval($Khachsan->Buffet),
        //         'isActive' => boolval($Khachsan->isActive),

        //     ];
        // }

        // return response()->json($responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Khachsan $data)
    {
        return view('khachsan.create', ['data' => $data]);
    }

    public function findbyMaDDDL(string $id)
    {
        //
        $Khachsans =  Khachsan::where('MaDDDL', '=', $id)->orderByDesc('UIDKS')->get();
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //     $this->validate($request, [
        //         'UIDKS' => 'required',
        //         'TenKS' => 'required',
        //         'DiaChi' => 'required',
        //         'SDT' => 'required',
        //         'MaDDDL' =>'required',



        //     ]);

        //     // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        //     $UIDKS = $request->input("UIDKS");
        //     $TenKS = $request->input("TenKS");
        //     $DiaChi =$request->input("DiaChi");

        //     // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        //     $SDT = $request->input("SDT");
        //     $MaDDDL=$request->input("MaDDDL");
        //     $isActive=$request->input("isActive")=="false"||$request->input("isActive")==null?false:true;
        //     $Buffet=$request->input("Buffet")=="false"||$request->input("Buffet")==null?false:true;
        //     $wifi=$request->input("Wifi")=="false"||$request->input("Wifi")==null?false:true;

        //     // $isAdminKH ="isAdminKH";

        //     if (!empty($UIDKS)) {

        //         $khachsan = new Khachsan();
        //         $khachsan->UIDKS = $UIDKS;
        //         $khachsan->TenKS = $TenKS;
        //         $khachsan->DiaChi = $DiaChi;
        //         $khachsan->SDT = $SDT;     
        //         $khachsan->isActive=$isActive;
        //         $khachsan->Buffet=$Buffet;
        //         $khachsan->Wifi=$wifi;
        //         $khachsan->MaDDDL=$MaDDDL;
        //         $khachsan->save();



        //         return response($khachsan, Response::HTTP_CREATED);
        //     } else {
        //         // handle the case where the image upload fails
        //         // e.g. return an error response or redirect back to the form with an error message
        //         return response()->json(["message"=>"eror"],404);
        //     }
        //     Khachsan::create($request->all());
        $data = new Khachsan();
        $data->TenKS = $request->TenKS;
        $data->DiaChi = $request->DiaChi;
        $data->Buffet = $request->Buffet;
        $data->Wifi = $request->Wifi;
        $data->isActive = $request->isActive;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();
        foreach ($request->file('imgs') as $img) {
            $imgPath = $img->store('public/imgs');
            $imgData = new Hinhanhk;
            $imgData->UIDKS = $data->UIDKS;
            $imgData->src = $imgPath;
            $imgData->save();
        }
        return redirect('admin/khachsan/create')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Khachsan::find($id);
        return view('khachsan.show', ['data' => $data]);
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
        $data = Khachsan::find($id);
        $data->TenKS = $request->TenKS;
        $data->DiaChi = $request->DiaChi;
        $data->Buffet = $request->Buffet;
        $data->Wifi = $request->Wifi;
        $data->isActive = $request->isActive;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();

        if ($request->hasFile('imgs')) {
            foreach ($request->files('imgs') as $img) {
                $imgPath = $img->store('public/imgs');
                $imgData = new Hinhanhk();
                $imgData->UIDKS = $data->UIDKS;
                $imgData->src = $imgPath;
                $imgData->save();
            }
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
