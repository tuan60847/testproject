<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hinhanhsukien;
use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HinhAnhSuKienController extends Controller
{
    //
    public function imageStore(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'MaSuKien' => 'required',
        ]);

        $image_path = (string) $request->file('image')->store('image/sukien', 'public');

        $MaSuKien = $request->input("MaSuKien");

        if (!empty($image_path)) {

            $hinhanhsk = new Hinhanhsukien();
            $hinhanhsk->src = $image_path;
            $hinhanhsk->MaSuKien = $MaSuKien;
            $hinhanhsk->save();
            // print("$hinhanhk");
            // $data = HinhanhK::create([
            //     'src' => $image_path,
            //     'UIDKS' => $UIDKS,
            // ]);


            return response($hinhanhsk, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
        }
    }

    public function getImageByUIDMaSukien($MaSuKien)
    {
        $hinhanhtps = Hinhanhsukien::where('maSuKien', $MaSuKien)->get();

        return response()->json($hinhanhtps, Response::HTTP_OK);
    }
    public function index()
    {
       $data=Hinhanhsukien::all();
       return view('imgEvent.imgSuKien',['data'=>$data]);
    }
    public function destroy($src)
    {
        $hinhanhk = Hinhanhsukien::findOrFail("image/sukien/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
