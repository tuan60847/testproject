<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hinhanhtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HinhAnhThanhPhoController extends Controller
{
    public function index()
    {
       $data=Hinhanhtp::all();
       return view('imgthanhpho.imgTP',['data'=>$data]);
    }
    public function imageStore(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'MaTP' => 'required',
        ]);

        $image_path = (string) $request->file('image')->store('image/thanhpho', 'public');

        $MaTP = $request->input("MaTP");

        if (!empty($image_path)) {

            $hinhanhtp = new Hinhanhtp();
            $hinhanhtp->src = $image_path;
            $hinhanhtp->MaTP = $MaTP;
            $hinhanhtp->save();
            // print("$hinhanhk");
            // $data = HinhanhK::create([
            //     'src' => $image_path,
            //     'UIDKS' => $UIDKS,
            // ]);


            return response($hinhanhtp, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
        }
    }

    public function getImageByUIDThanhPho($MaTP)
    {
        $hinhanhtps = Hinhanhtp::where('MaTP', $MaTP)->get();

        return response()->json($hinhanhtps, Response::HTTP_OK);
    }
    public function destroy($src)
    {
        $hinhanhk = Hinhanhtp::findOrFail("image/thanhpho/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
