<?php

namespace App\Http\Controllers;

use App\Models\Diadiemdulich;
use App\Models\Hinhanhdddl;
use App\Models\Thanhpho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use DB;

class DiaDiemDuLichController extends Controller
{
    public function index()
    {
        $data = Diadiemdulich::all();
        return view('diadiemdulich.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Diadiemdulich::all();
        return view('diadiemdulich.create', ['data' => $data]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'TenDiaDiemDuLich' => 'required',
            'DiaChi' => 'required',
            'MoTa' => 'required',
            'GiaTien' => 'required',
            'MaTP' => 'required',
            'ThoiGianHoatDong' => 'required',
        ]);

        $data = new Diadiemdulich();
        $data = new Thanhpho();
        $data->TenDiaDiemDuLich = $request->DiaDiemDuLich;
        $data->DiaChi = $request->DiaChi;
        $data->MoTa = $request->MoTa;
        $data->GiaTien = $request->GiaTien;
        $data->MaTP = $request->MaTP;
        $data->ThoiGianHoatDong = $request->ThoiGianHoatDong;
        $data->save();
        return redirect('createDDDl')->with('success', 'data has been');

        foreach ($request->file('imgs') as $img) {
            $imgPath = $img->store('public/imgs');
            $imgData = new Hinhanhdddl();
            $imgData->MaDDDL = $data->MaDDDL;
            $imgData->src = $imgPath;
            $imgData->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Diadiemdulich::find($id);
        return view('diadiemdulich.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Diadiemdulich::find($id);
        return view('diadiemdulich.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Diadiemdulich::find($id);
        $data->TenDiaDiemDuLich = $request->TenDiaDiemDuLich;
        $data->DiaChi = $request->DiaChi;
        $data->MoTa = $request->MoTa;
        $data->ThoiGianHoatDong = $request->ThoiGianHoatDong;
        $data->GiaTien = $request->GiaTien;
        $data->MaTp = $request->MaTP;
        $data->save();

        if ($request->hasFile('imgs')) {
            foreach ($request->files('imgs') as $img) {
                $imgPath = $img->store('public/imgs');
                $imgData = new Hinhanhdddl;
                $imgData->MaDDDL = $data->MaDDDL;
                $imgData->src = $imgPath;
                $imgData->save();
            }
        }
        return redirect('admin/diadiemdulich/' . $id . '/edit')->with('success', 'Địa điểm đã được cập nhật');
        // //
        // $this->validate($request, [

        //     'TenDiaDiemDuLich' => 'required',
        //     'MoTa' => 'required',
        //     'MaTP' => 'required',
        //     'DiaChi' => 'required',


        // ]);

        // // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');
        // $TenDiaDiemDuLich = $request->input("TenDiaDiemDuLich");
        // $MoTa = $request->input("MoTa");
        // $ThoiGianHoatDong = $request->input("ThoiGianHoatDong");
        // $DiaChi = $request->input("DiaChi");
        // // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');
        // $GiaTien = $request->input("GiaTien");
        // $MaTP = $request->input("MaTP");


        // // $isAdminKH ="isAdminKH";

        // if (!empty($TenDiaDiemDuLich)) {

        //     $diadiemdulich = new Diadiemdulich();

        //     $diadiemdulich->TenDiaDiemDuLich = $TenDiaDiemDuLich;
        //     $diadiemdulich->MoTa = $MoTa;
        //     $diadiemdulich->ThoiGianHoatDong = $ThoiGianHoatDong;
        //     $diadiemdulich->GiaTien = $GiaTien;
        //     $diadiemdulich->MaTP = $MaTP;
        //     $diadiemdulich->DiaChi = $DiaChi;


        //     $diadiemdulich->save();



        //     return response($diadiemdulich, Response::HTTP_CREATED);
        // } else {
        //     // handle the case where the image upload fails
        //     // e.g. return an error response or redirect back to the form with an error message
        //     return response()->json(["message" => "eror"], 404);
        // }
    }

    public function findbyMaTP(string $MaTP)
    {
        return Diadiemdulich::where('MaTP', '=', $MaTP)->get();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Diadiemdulich::where('MaDDDL', $id)->delete();
        return redirect('admin/diadiemdulich/')->with('success', 'Địa điểm đã được xóa');
    }
    public function destroy_image($img_id)
    {
        $data = Hinhanhdddl::where('MaTP', $img_id)->first();
        Storage::delete($data->src);

        Hinhanhdddl::where('MaTP', $img_id)->delete();
        return response()->json(['bool' => true]);
    }
}
