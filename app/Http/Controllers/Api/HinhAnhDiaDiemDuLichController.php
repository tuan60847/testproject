<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hinhanhdddl;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HinhAnhDiaDiemDuLichController extends Controller
{
    //
    public function imageStore(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'MaDDDL' => 'required',
        ]);

        $image_path = (string) $request->file('image')->store('image/diadiemdulich', 'public');

        $MaDDDL = $request->input("MaDDDL");

        if (!empty($image_path)) {

            $hinhanhdddl = new Hinhanhdddl();
            $hinhanhdddl->src = $image_path;
            $hinhanhdddl->MaDDDL = $MaDDDL;
            $hinhanhdddl->save();
            // print("$hinhanhk");
            // $data = HinhanhK::create([
            //     'src' => $image_path,
            //     'UIDKS' => $UIDKS,
            // ]);


            return response($hinhanhdddl, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
        }
    }

    public function getImageByUIDDDDL($MaDDDL)
    {
        $hinhanhtps = Hinhanhdddl::where('MaDDDL', $MaDDDL)->get();

        return response()->json($hinhanhtps, Response::HTTP_OK);
    }
    public function index()
    {
        return Hinhanhdddl::all();
    }
    public function destroy($src)
    {
        $hinhanhk = Hinhanhdddl::findOrFail("image/diadiemdulich/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
