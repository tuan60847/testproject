<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HinhanhK;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class ImageKSController extends Controller
{
    //
    public function imageStore(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'UIDKS' => 'required',
        ]);

        $image_path = (string) $request->file('image')->store('image/khachsan', 'public');

        $UIDKS = $request->input("UIDKS");

        if (!empty($image_path)) {

            $hinhanhk = new HinhanhK();
            $hinhanhk->src = $image_path;
            $hinhanhk->UIDKS = $UIDKS;
            $hinhanhk->save();
            // print("$hinhanhk");
            // $data = HinhanhK::create([
            //     'src' => $image_path,
            //     'UIDKS' => $UIDKS,
            // ]);


            return response($hinhanhk, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
        }
    }
    public function index()
    {
        return HinhanhK::all();
    }
    public function destroy($src)
    {
        $hinhanhk = HinhanhK::findOrFail("image/khachsan/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        return response(null, Response::HTTP_NO_CONTENT);

        // return $hinhanhk->delete();
    }

    public function findlast($id)
    {
        $UIDKS = $id;

        $hinhanhk = HinhanhK::where('UIDKS', $UIDKS)->latest('UIDKS')->first();

        if ($hinhanhk) {
            // Found the HinhanhK record with matching UIDKS
            // Do something with the $hinhanhk object
            return response($hinhanhk, Response::HTTP_OK);
        } else {
            // No HinhanhK record with matching UIDKS found
            // Handle the error case appropriately
        }
    }

    public function hienthi()
    {
        $hinhanhk = new HinhanhK();
        return view('imgKhachsan.index', ['hinhanhk' => $hinhanhk]);
    }
}
