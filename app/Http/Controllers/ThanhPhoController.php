<?php

namespace App\Http\Controllers;

use App\Models\Khachsan;
use App\Models\Thanhpho;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use DB;
class ThanhPhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =Thanhpho::all();
       return view('thanhpho.city',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('thanhpho.createTP');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =new Thanhpho();
       $data->TenTP=$request->TenTP;
       $data->mota=$request->mota;
       $data->save();
       return redirect('createTP')->route('thanhpho.createTP')->with('success','data has been');
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
        $data= Thanhpho::find($id);
        return view('thanhpho.showTP',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data= Thanhpho::find($id);
        return view('thanhpho.editTP',['data'=>$data]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
    //     $data->update($request->all());
    //    return redirect('city/'.$id.'/edit')->route('thanhpho.city')->with('success','thành công');
      
    $data= Thanhpho::find($id);
    $data->TenTP=$request->TenTP;
    $data->mota=$request->mota;
    $data->save();
    return redirect('city/'.$id.'/edit')->with('success','Thành phố đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $data->delete();
        // return redirect('city/'.$id.'/delete')->route('thanhpho.city')->with('success','xóa thành công');
        $data= Thanhpho::where('MaTP',$id)->delete();
        return redirect('city/')->with('success','Thành phố đã được xóa');
    }
}
