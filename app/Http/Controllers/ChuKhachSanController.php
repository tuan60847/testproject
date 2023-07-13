<?php

namespace App\Http\Controllers;

use App\Models\Chukhachsan;
use App\Models\Khachsan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChuKhachSanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Chukhachsan::all();
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
        //
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
        $NgaySinh =$request->input("NgaySinh");

        
        $HoTen = $request->input("HoTen");
        $cmnd =$request->input("cmnd");
        $SDT = $request->input("SDT");
       
        
        
        if (!empty($Email)) {
           
            $chukhachsan = new Chukhachsan();
            $chukhachsan->Email = $Email;
            $chukhachsan->Password = $Password;
            $chukhachsan->NgaySinh = $NgaySinh;
            $chukhachsan->HoTen = $HoTen;
            $chukhachsan->SDT = $SDT;
            $chukhachsan->cmnd= $cmnd;
            $chukhachsan->ADMINKS=$cmnd."_".$SDT;
            
            
            $chukhachsan->save();
            
            
           
            return response($chukhachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Chukhachsan::findOrFail($id);
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
        $chukhachsan=Chukhachsan::findOrFail($id);
        $this->validate($request, [
            
            'Password' => 'required',
            'HoTen' => 'required',
            'NgaySinh' => 'required|date_format:Y-m-d',
            'cmnd' => 'required',
            'SDT' => 'required',
            
            
        ]);
        
        
       
        $Password = $request->input("Password");
        $NgaySinh =$request->input("NgaySinh");

    
        $HoTen = $request->input("HoTen");
        $cmnd =$request->input("cmnd");
        $SDT = $request->input("SDT");
       
        
        
        if (!empty($chukhachsan)) {

            $chukhachsan->Password = $Password;
            $chukhachsan->NgaySinh = $NgaySinh;
            $chukhachsan->HoTen = $HoTen;
            $chukhachsan->SDT = $SDT;
            $chukhachsan->cmnd= $cmnd;      
            $chukhachsan->save();

            return response($chukhachsan);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
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
}
