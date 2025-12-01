<?php

namespace App\Http\Controllers;

use App\Models\Diadiemdulich;
use App\Models\Hinhanhdddl;
use App\Models\Thanhpho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use DB;

class DiaDiemDuLichWebController extends Controller
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
        // $request->validate([
        //     'TenDiaDiemDuLich' => 'required',
        //     'DiaChi' => 'required',
        //     'MoTa' => 'required',
        //     'GiaTien' => 'required',
        //     'MaTP' => 'required',
        //     'ThoiGianHoatDong' => 'required',
        // ]);

        $data = new Diadiemdulich();
        //  $dataTP = new Thanhpho();
        $data->TenDiaDiemDuLich = $request->TenDiaDiemDuLich;
        $data->DiaChi = $request->DiaChi;
        $data->MoTa = $request->MoTa;
        $data->GiaTien = $request->GiaTien;
        $data->MaTP = $request->MaTP;
        $data->ThoiGianHoatDong = $request->ThoiGianHoatDong;
        $data->save();
        return redirect('admin/diadiemdulich/create')->with('success', 'Địa điểm du lịch đã được thêm');

        foreach ($request->file('image') as $img) {
            $imgPath = $img->store('diadiemdulich', 'public');
            $imgData = new Hinhanhdddl();
            $imgData->MaDDDL = $data->MaDDDL;
            $imgData->src = 'image/' . $imgPath;
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

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $imgPath = $img->store('diadiemdulich', 'public');
                $imgData = new Hinhanhdddl;
                $imgData->MaDDDL = $data->MaDDDL;
                $imgData->src = 'image/' .  $imgPath;
                $imgData->save();
            }
        }
        return redirect('admin/diadiemdulich/' . $id . '/edit')->with('success', 'Địa điểm đã được cập nhật');
    }

    public function findbyMaTP(string $MaTP)
    {
        return Diadiemdulich::where('MaTP', '=', $MaTP)->get();
    }

    public function TimDiaDiemDuLich(Request $request)
    {
        //

        $this->validate($request, [
            'Search' => 'required',
        ]);


        $Search = $request->input("Search");
        $diadiemdulichs = Diadiemdulich::where('TenDiaDiemDuLich', 'LIKE', '%' . $Search . '%')
            ->orWhere('DiaChi', 'LIKE', '%' . $Search . '%')
            ->get();

        if (!empty($diadiemdulichs)) {

            return $diadiemdulichs;
        } else {

            return response()->json(["message" => "eror"], 404);
        }
    }

    public function destroy(string $id)
    {
        Diadiemdulich::where('MaDDDL', $id)->delete();
        return redirect('admin/diadiemdulich/')->with('success', 'Địa điểm đã được xóa');
    }
    public function destroy_image($src)
    {
        $hinhanhk = Hinhanhdddl::findOrFail("image/diadiemdulich/" . $src);

        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return redirect('/admin/diadiemdulich/' . $hinhanhk->MaDDDL . '/edit');
    }
}
