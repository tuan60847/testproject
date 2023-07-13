<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Khachsan;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $favorites = Favorite::where('isActive', '!=', 0)->get();
        $responseData = [];
        foreach ($favorites as $favorite) {
            $responseData[] = [
                'Email' => $favorite->Email,
                'UIDKS' => $favorite->UIDKS,
            ];
        }
        return $responseData;
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
    public function SetFavorite(Request $request)
    {
        //
        $this->validate($request, [
            'Email' => 'required',
            'UIDKS' => 'required',
        ]);


        $Email = $request->input("Email");
        $UIDKS = $request->input("UIDKS");
        
        $favorite = Favorite::where('Email', '=', $Email)->where('UIDKS', '=', $UIDKS)->first();
        // return $favorite;
        
        if(!$favorite){
            $newfavorite = new Favorite();
            $newfavorite->Email=$Email;
            $newfavorite->UIDKS=$UIDKS;
            return $newfavorite->save();
        }else{
            $favorite->isActive =  !$favorite->isActive;
            return $favorite->update();
           
        }
        
    }

    public function getKhachSanFavoriteByKH(Request $request)
    {
        //
        $this->validate($request, [
            'Email' => 'required',
          
        ]);


        $Email = $request->input("Email");

       
        $favorites = Favorite::where('Email', '=', $Email)->get();
        $responseData = [];
       
    // foreach ($Khachsans as $Khachsan) {
   
    // }
        foreach ( $favorites as $favorite){
            $Khachsan = Khachsan::findOrFail($favorite->UIDKS);
            $responseData[] = [
                'UIDKS' => $Khachsan->UIDKS,
                'TenKS' => $Khachsan->TenKS,
                'DiaChi' => $Khachsan->DiaChi,
                'SDT' => $Khachsan->SDT,
                'MaDDDL' => $Khachsan->MaDDDL,
                'Wifi' => boolval($Khachsan->Wifi),
                'Buffet' => boolval($Khachsan->Buffet),
                'isActive' => boolval($Khachsan->isActive),
                
            ];
        }
        return $responseData;
        
        
        
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
