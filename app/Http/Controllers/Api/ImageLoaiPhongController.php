<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hinhanhloaiphong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ImageLoaiPhongController extends Controller
{
    //
    public function imageStore(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'UIDLoaiPhong' => 'required',
        ]);

        $image_path = (string) $request->file('image')->store('image/loaiphong', 'public');

        $UIDLoaiPhong = $request->input("UIDLoaiPhong");

        if (!empty($image_path)) {

            $hinhanhloaiphong = new Hinhanhloaiphong();
            $hinhanhloaiphong->src = $image_path;
            $hinhanhloaiphong->UIDLoaiPhong = $UIDLoaiPhong;
            $hinhanhloaiphong->save();
            // print("$hinhanhk");
            // $data = HinhanhK::create([
            //     'src' => $image_path,
            //     'UIDKS' => $UIDKS,
            // ]);


            return response($hinhanhloaiphong, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
        }
    }

    public function getImageByUIDLoaiPhong($UIDLoaiPhong)
    {
        $hinhanhloaiphongs = Hinhanhloaiphong::where('UIDLoaiPhong', $UIDLoaiPhong)->get();

        return response()->json($hinhanhloaiphongs, Response::HTTP_OK);
    }
    public function index()
    {
        return Hinhanhloaiphong::all();
    }
    public function destroy($src)
    {
        $hinhanhk = Hinhanhloaiphong::findOrFail("image/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


    // public function showImage($filename)
    // {
    //     $path = 'public/image/loaiphong/' . $filename;

    //     if (Storage::exists($path)) {
    //         return asset('storage/image/loaiphong/' . $filename);
    //     } else {
    //         abort(404);
    //     }
    // }
    public function showImage($filename)
    {
        $path = 'public/image/loaiphong/' . $filename;

        if (Storage::exists($path)) {
            return view('hinhtest', ['filename' => $filename]);
        } else {
            abort(404);
        }
    }
}
