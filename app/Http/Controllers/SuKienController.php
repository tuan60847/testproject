<?php

namespace App\Http\Controllers;

use App\Models\Diadiemdulich;
use App\Models\Hinhanhsukien;
use App\Models\Sukien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use DB;

class SuKienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sukien::all();
        return view('sukien.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Sukien::all();
        return view('sukien.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //     //
        $request->validate([

            'TenSuKien' => 'required',
            'Mota' => 'required',
            'NgayBatDau' => 'required|date_format:Y-m-d',
            'MaDDDL' => 'required',


        ]);

        //     // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');

        //     $TenSuKien = $request->input("TenSuKien");
        //     $Mota = $request->input("Mota");
        //     $NgayBatDau =$request->input("NgayBatDau");
        //     $NgayKetThuc =$request->input("NgayKetThuc");
        //     // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');


        //     $MaDDDL = $request->input("MaDDDL");

        //     // $isAdminKH ="isAdminKH";

        //     if (!empty($TenSuKien)) {

        //         $sukien = new Sukien();
        //         $sukien->TenSuKien = $TenSuKien;
        //         $sukien->Mota = $Mota;
        //         $sukien->NgayBatDau = $NgayBatDau;
        //         $sukien->NgayKetThuc = $NgayKetThuc;
        //         $sukien->MaDDDL = $MaDDDL;





        //         $sukien->save();



        //         return response($sukien, Response::HTTP_CREATED);
        //     } else {
        //         // handle the case where the image upload fails
        //         // e.g. return an error response or redirect back to the form with an error message
        //         return response()->json(["message"=>"eror"],404);
        //     }
        $data = new Sukien();
        //  $data = new Diadiemdulich();
        $data->TenSuKien = $request->TenSuKien;
        $data->Mota = $request->Mota;
        $data->NgayBatDau = $request->NgayBatDau;
        $data->NgayKetThuc = $request->NgayKetThuc;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();

        foreach ($request->file('image') as $img) {
            $imgPath = $img->store('sukien', 'public');
            $imgData = new Hinhanhsukien();
            $imgData->maSuKien = $data->maSuKien;
            $imgData->src = 'image/' . $imgPath;
            $imgData->save();
        }
        return redirect('admin/sukien/create')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Sukien::find($id);
        return view('sukien.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Sukien::find($id);
        return view('sukien.edit', ['data' => $data]);
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
        // //
        // $sukien = Sukien::findOrFail($id);
        // $this->validate($request, [

        //     'TenSuKien' => 'required',
        //     'Mota' => 'required',
        //     'NgayBatDau' => 'required|date_format:Y-m-d',
        //     'MaDDDL' => 'MaDDDL',


        // ]);

        // // $image_path =(string) $request->file('image')->store('image/khachsan', 'public');

        // $TenSuKien = $request->input("TenSuKien");
        // $Mota = $request->input("Mota");
        // $NgayBatDau = $request->input("NgayBatDau");
        // $NgayKetThuc = $request->input("NgayKetThuc");
        // // $dateNgaySinh = Carbon::parse("2001-07-21")->format('Y-m-d');


        // $MaDDDL = $request->input("MaDDDL");

        // // $isAdminKH ="isAdminKH";

        // if (!empty($sukien)) {


        //     $sukien->TenSuKien = $TenSuKien;
        //     $sukien->Mota = $Mota;
        //     $sukien->NgayBatDau = $NgayBatDau;
        //     $sukien->NgayKetThuc = $NgayKetThuc;
        //     $sukien->MaDDDL = $MaDDDL;


        //     return $sukien->update();
        // } else {
        //     // handle the case where the image upload fails
        //     // e.g. return an error response or redirect back to the form with an error message
        //     return response()->json(["message" => "eror"], 404);
        // }
        $data = Sukien::find($id);
        $data->TenSuKien = $request->TenSuKien;
        $data->Mota = $request->Mota;
        $data->NgayBatDau = $request->NgayBatDau;
        $data->NgayKetThuc = $request->NgayKetThuc;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $imgPath = $img->store('sukien', 'public');
                $imgData = new Hinhanhsukien();
                $imgData->maSuKien = $data->maSuKien;
                $imgData->src = 'image/' .  $imgPath;
                $imgData->save();
            }
        }
        return redirect('admin/sukien/' . $id . '/edit')->with('success', 'Sự kiện đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sukien::where('maSuKien', $id)->delete();
        return redirect('admin/sukien/')->with('success', 'Sự kiện đã được xóa');
    }
    public function destroy_image($src)
    {
        $hinhanhk = Hinhanhsukien::findOrFail("image/sukien/" . $src);

        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        // return response(null, Response::HTTP_NO_CONTENT);
        return redirect('admin/sukien/' . $hinhanhk->MaSuKien . '/edit');
    }
}
