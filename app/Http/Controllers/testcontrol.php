<?php

namespace App\Http\Controllers;

use App\Models\Khachhang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class testcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customers = Khachhang::all();

        $responseData = [];
        foreach ($customers as $customer) {
            $responseData[] = [
                'Email' => $customer->Email,
                'Password' => $customer->Password,
                'NgaySinh' => $customer->NgaySinh,
                'HoTen' => $customer->HoTen,
                'cmnd' => $customer->cmnd,
                'SDT' => $customer->SDT,
                'isDatPhong' => boolval($customer->isDatPhong),
            ];
        }

        return response()->json($responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Email' => 'required',
            'Password' => 'required',
            'HoTen' => 'required',
            'NgaySinh' => 'required|date_format:Y-m-d',
            
            'cmnd' => 'required',
            'SDT' => 'required',
        ]);
        $Email = $request->input("Email");
        $Password = $request->input("Password");
        $NgaySinh = $request->input("NgaySinh");
        $HoTen = $request->input("HoTen");
        $cmnd = $request->input("cmnd");
        $SDT = $request->input("SDT");
        $isDatPhong = $request->input("isDatPhong") == "false" || $request->input("isDatPhong") == null ? false : true;


        if (!empty($Email)) {

            $khachhang = new Khachhang();
            $khachhang->Email = $Email;
            $khachhang->Password = $Password;
            $khachhang->NgaySinh = $NgaySinh;
            $khachhang->HoTen = $HoTen;
            $khachhang->SDT = $SDT;
            $khachhang->cmnd = $cmnd;
            $khachhang->isDatPhong = $isDatPhong;


            $khachhang->save();



            return response($khachhang, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $khachhang = Khachhang::find($id);
        $responseData = [
            'Email' => $khachhang->Email,
            'Password' => $khachhang->Password,
            'NgaySinh' => $khachhang->NgaySinh,
            'HoTen' => $khachhang->HoTen,
            'cmnd' => $khachhang->cmnd,
            'SDT' => $khachhang->SDT,
            'isDatPhong' => boolval($khachhang->isDatPhong),
        ];

        // Trả về dữ liệu dưới dạng JSON
        return response()->json($responseData);
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
        //
        $khachhang = Khachhang::findOrFail($id);
        $this->validate($request, [
            'Password' => 'required',
            'HoTen' => 'required',
            'NgaySinh' => 'required|date_format:Y-m-d',
            'cmnd' => 'required',
            'SDT' => 'required',
        ]);
        $Password = $request->input("Password");
        $NgaySinh = $request->input("NgaySinh");
        $HoTen = $request->input("HoTen");
        $cmnd = $request->input("cmnd");
        $SDT = $request->input("SDT");
        $isDatPhong = $request->input("isDatPhong") == "false" || $request->input("isDatPhong") == null ? false : true;
        if (!empty($khachhang)) {
            $khachhang->Password = $Password;
            $khachhang->NgaySinh = $NgaySinh;
            $khachhang->HoTen = $HoTen;
            $khachhang->SDT = $SDT;
            $khachhang->cmnd = $cmnd;
            $khachhang->isDatPhong = $isDatPhong;


            return $khachhang->update();
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $khachhang = Khachhang::find($id);
        return $khachhang->delete();
    }

    public function setoff($id)
    {
        $khachhang = Khachhang::findOrFail($id);
        if (!empty($khachhang)) {
            $khachhang->isDatPhong = false;
            return $khachhang->update();
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }
    public function seton($id)
    {
        $khachhang = Khachhang::findOrFail($id);
        if (!empty($khachhang)) {
            $khachhang->isDatPhong = true;
            return $khachhang->update();
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    // public function adminKH($id){
    //     $khachhang = Khachhang::findOrFail($id);
    //     if(!empty($khachhang)){
    //         $array = [$khachhang->cmnd,$khachhang->SDT];
    //         $khachhang->isAdminKH=implode("_",$array);

    //         return $khachhang->update();
    //     }
    //     else {
    //         // handle the case where the image upload fails
    //         // e.g. return an error response or redirect back to the form with an error message
    //         return response()->json(["message"=>"eror"],404);
    //     }
    // }

}
