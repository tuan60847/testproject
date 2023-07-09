<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Dondatphong;

class AdminController extends Controller
{
    function login(){
        return view('login');
    }
    function check_login(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $admin=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->count();

        if($admin>0){
            $adminData=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->get();
            session(['adminData'=>$adminData]);
        }else{
            return redirect('admin/login')->with('msg','Invalid username/Password!!');
        }
    }

    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    function dashboard(){
        $bookings=Dondatphong::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();
        $labels=[];
        $data=[];
        foreach($bookings as $booking){
            $labels[]=$booking['checkin_date'];
            $data[]=$booking['total_bookings'];
        }

        
        return view('deshbord',['labels'=>$labels,'data'=>$data]);
        
    }

}
