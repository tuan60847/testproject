<?php

namespace App\Http\Controllers;

use App\Models\Chukhachsan;
use App\Models\Khachsan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ChuKhachSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Chukhachsan::all();
        if ($request->ADMINKS != "1") {
            return view('chukhachsan.index', ['data' => $data]);
        }
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
        $data = new Chukhachsan();
        $data->HoTen = $request->HoTen;
        $data->NgaySinh = $request->NgaySinh;
        $data->SDT = $request->SDT;
        $data->Email = $request->Email;
        $data->cmnd = $request->cmnd;
        $data->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data = Chukhachsan::find($id);
        return view('chukhachsan.show', ['data' => $data]);
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
        $chukhachsan = Chukhachsan::findOrFail($id);
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



        if (!empty($chukhachsan)) {


            $chukhachsan->Email = $Email;
            $chukhachsan->Password = $Password;
            $chukhachsan->NgaySinh = $NgaySinh;
            $chukhachsan->HoTen = $HoTen;
            $chukhachsan->SDT = $SDT;
            $chukhachsan->cmnd = $cmnd;
            $chukhachsan->save();



            return response($chukhachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $chukhachsan = Chukhachsan::find($id);
        return $chukhachsan->delete();
    }
    function login()
    {
        return view('login');
    }
    function check_loginWeb(Request $request)
    {
        $request->validate([
            'Email' => 'required',
            'Password' => 'required',
        ]);



        $cks = Chukhachsan::where(['Email' => $request->Email, 'Password' => $request->Password])->count();

        if ($cks > 0) {
            $cksData = Chukhachsan::where(['Email' => $request->Email, 'Password' => $request->Password])->first();

            session(['cksData' => $cksData]);
            if ($request->has('remenberme')) {
                Cookie::queue('adminuser', $request->Email, 1440);
                Cookie::queue('adminpwd', $request->Password, 1440);
            }
            if ($cksData->ADMINKS === "1") {
                return redirect('admin');
            } else if ($cksData->ADMINKS != "1") {
                return redirect('adminKS');
            }
        } else {
            return redirect('login')->with('msg', 'Yêu cầu nhập email/password!');
        }
    }
    function logout()
    {
        session()->forget(['cksData']);
        return redirect('login');
    }
}
