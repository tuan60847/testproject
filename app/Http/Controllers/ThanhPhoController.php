<?php

namespace App\Http\Controllers;

use App\Models\Khachsan;
use App\Models\Thanhpho;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class ThanhPhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Thanhpho::all();
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Thanhpho::findOrFail($id);
    }
    public function getThanhPhoByName(string $name){
        
        return Thanhpho::where('TenTP', $name)->first();
        

        
    }

    public function TimThanhPho(Request $request)
    {
        //
    
        $this->validate($request, [
            'Search' => 'required',
        ]);
        
        
        $Search = $request->input("Search");   
        $thanhphos = Thanhpho::where('TenTP', 'LIKE', '%' . $Search . '%')
                    ->get();
        
        // $isAdminKH ="isAdminKH";
        
        if (!empty($thanhphos)) {

            return $thanhphos;

            // return response($khachsan, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message"=>"eror"],404);
        }
       

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
