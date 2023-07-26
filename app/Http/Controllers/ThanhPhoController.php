<?php

namespace App\Http\Controllers;

use App\Models\Khachsan;
use App\Models\Thanhpho;
use App\Models\Hinhanhtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Storage;

class ThanhPhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Thanhpho::all();
        return view('thanhpho.index', ['data' => $data]);
    }

    public function indexWeb()
    {
        $data = Thanhpho::all();
        return view('thanhpho.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Thanhpho $data)
    {
        return view('thanhpho.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenTP' => 'required',
            'mota' => 'required',
        ]);
        $data = new Thanhpho();
        $data->TenTP = $request->TenTP;
        $data->mota = $request->mota;
        $data->save();
        foreach ($request->file('image') as $img) {
            $imgPath = $img->store('thanhpho', 'public');
            $imgData = new Hinhanhtp;
            $imgData->MaTP = $data->MaTP;
            $imgData->src = $imgPath;
            $imgData->save();
        }
        return redirect('admin/thanhpho/create')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //     //
        //     return Thanhpho::findOrFail($id);
        // }
        // public function getThanhPhoByName(string $name){

        //     return Thanhpho::where('TenTP', $name)->first();
        $data = Thanhpho::find($id);
        return view('thanhpho.show', ['data' => $data]);
    }

    public function TimThanhPho(Request $request)
    {
        //

        $this->validate($request, [
            'Search' => 'required',
        ]);


        $Search = $request->input("Search");
        $thanhphos = Thanhpho::where('TenTP', 'LIKE', '%' . $Search . '%')
            ->get();

        // $isAdminKH ="isAdminKH";

        if (!empty($thanhphos)) {

            return $thanhphos;

            // return response($khachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Thanhpho::find($id);
        return view('thanhpho.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $MaTP)
    {
        //     $data->update($request->all());
        //    return redirect('city/'.$id.'/edit')->route('thanhpho.city')->with('success','thành công');

        $data = Thanhpho::findOrFail($MaTP);
        $data->TenTP = $request->TenTP;
        $data->mota = $request->mota;
        $data->save();
        if ($request->hasFile('image')) {
            foreach ($request->files('image') as $img) {
                $imgPath = $img->store('thanhpho', 'public');
                $imgData = new Hinhanhtp;
                $imgData->MaTP = $data->MaTP;
                $imgData->src = $imgPath;
                $imgData->save();
            }
        }
        return redirect('admin/thanhpho/' . $MaTP . '/edit')->with('success', 'Thành phố đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Thanhpho::where('MaTP', $id)->delete();
        return redirect('admin/thanhpho/')->with('success', 'Thành phố đã được xóa');
    }
    public function destroy_image($src)
    {
        $hinhanhk = Hinhanhtp::findOrFail("image/thanhpho/" . $src);

        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        // return response(null, Response::HTTP_NO_CONTENT);
        return redirect('/admin/thanhpho/' . $hinhanhk->MaTP . '/edit');
    }
}
