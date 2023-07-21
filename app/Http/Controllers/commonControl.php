<?php

namespace App\Http\Controllers;

use App\Models\Chukhachsan;
use App\Models\Ctddp;
use App\Models\Dondatphong;
use App\Models\Khachhang;
use App\Models\Loaiphong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class commonControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function SendMailThanksUser(string $EmailKH)
    {

        $khachhang = Khachhang::findOrFail($EmailKH);

        Mail::send('emails.test', ['khachhang' => $khachhang], function ($email) use ($EmailKH, $khachhang) {
            $email->subject("Thanks For User");
            $email->to($EmailKH, $khachhang->HoTen);
        });
        return true;
    }

    public function SendMailThanksCKS(string $EmailKH)
    {

        $chukhachsan = Chukhachsan::findOrFail($EmailKH);

        Mail::send('emails.thankscks', ['chukhachsan' => $chukhachsan], function ($email) use ($EmailKH, $chukhachsan) {
            $email->subject("Thanks For User");
            $email->to($EmailKH, $chukhachsan->HoTen);
        });
        return true;
    }

    public function SendMailFogetPasswordUser(string $EmailKH)
    {

        $khachhang = Khachhang::findOrFail($EmailKH);
        if ($khachhang) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = substr(str_shuffle($characters), 0, 10);
            $request = Request::capture();
            $currentIP = $request->ip();
            $resetPasswordLink = 'http://' . $currentIP . ':8000/api/reset-password-user/' . $khachhang->Email . '&&' . $randomString;
            $renderbody = [
                'Email' => $khachhang->Email,
                'HoTen' => $khachhang->HoTen,
                'randomString' => $randomString,
                'resetPasswordLink' => $resetPasswordLink
            ];


            Mail::send('emails.forgetpasswordkhachhang', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                $email->subject("Forget Password");
                $email->to($EmailKH, $khachhang->HoTen);
            });
            return true;
        } else {
            return  response()->json(["message" => "eror"], 404);
        }
    }
    public function ResetPasswordUser(Request $request)
    {
        //
        $this->validate($request, [
            'email' => 'required',
            'newPassword' => 'required',
        ]);
        $email = $request->input("email");
        $newPassword = $request->input("newPassword");
        $khachhang = Khachhang::findOrFail($email);

        if ($khachhang) {
            $khachhang->Password = $newPassword;
            return $khachhang->update();
        } else {
            return response()->json(["message" => "eror"], 404);
        }
    }


    public function ResetPasswordUserGet($email, $newpassword)
    {
        //
        $khachhang = Khachhang::findOrFail($email);

        if ($khachhang) {
            $khachhang->Password = $newpassword;
            return $khachhang->update();
        } else {
            return response()->json(["message" => "eror"], 404);
        }
    }

    public function SendMailFogetPasswordCKS(string $EmailKH)
    {
        $chukhachsan = Chukhachsan::findOrFail($EmailKH);
        if ($chukhachsan) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = substr(str_shuffle($characters), 0, 10);
            $request = Request::capture();
            $currentIP = $request->ip();
            $resetPasswordLink = 'http://' . $currentIP . ':8000/api/reset-password-cks/' . $chukhachsan->Email . '&&' . $randomString;
            $renderbody = [
                'Email' => $chukhachsan->Email,
                'HoTen' => $chukhachsan->HoTen,
                'randomString' => $randomString,
                'resetPasswordLink' => $resetPasswordLink
            ];
            Mail::send('emails.forgetpasswordkhachhang', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $chukhachsan) {
                $email->subject("Forget Password");
                $email->to($EmailKH, $chukhachsan->HoTen);
            });
            return true;
        } else {
            return  response()->json(["message" => "eror"], 404);
        }
    }


    public function ResetPasswordCKSGet($email, $newpassword)
    {
        //
        $chukhachsan = Chukhachsan::findOrFail($email);

        if ($chukhachsan) {
            $chukhachsan->Password = $newpassword;
            return $chukhachsan->update();
        } else {
            return response()->json(["message" => "eror"], 404);
        }
    }

    public function SendMailDoneDDP(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'UIDDatPhong' => 'required',
        ]);
        $EmailKH = $request->input("email");
        $UIDDatPhong = $request->input("UIDDatPhong");

        $khachhang = Khachhang::findOrFail($EmailKH);
        $DDP = Dondatphong::findOrFail($UIDDatPhong);
        $ChiTietDonDatPhongs = Ctddp::where('MaDDP', $UIDDatPhong)->get();
        $renderBodyChiTietDonDatPhong = [];
        foreach ($ChiTietDonDatPhongs as $ChiTietDonDatPhong) {
            $loaiPhong = Loaiphong::findOrFail($ChiTietDonDatPhong->UIDLoaiPhong);
            $renderBodyChiTietDonDatPhong[] = [
                'TenLoaiPhong' => $loaiPhong->TenLoaiPhong,
                'SoNgayO' => $ChiTietDonDatPhong->SoNgayO,
                'soLuongPhong' => $ChiTietDonDatPhong->soLuongPhong,
                'Tien' => $ChiTietDonDatPhong->Tien,
            ];
        }


        if ($khachhang) {
            $renderbody = [
                'Email' => $khachhang->Email,
                'HoTen' => $khachhang->HoTen,
                'MaDDP' => $UIDDatPhong,
                'GiaTien' => $DDP->tongtien,
                'ChiTietDonDatPhong' => $renderBodyChiTietDonDatPhong,
            ];
            // return $renderbody;
            Mail::send('emails.statusddp', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                $email->subject("Booking Invoice");
                $email->to($EmailKH, $khachhang->HoTen);
            });
            return true;
        } else {
            return  response()->json(["message" => "eror"], 404);
        }
    }

    public function SendMailDeclinedDDP(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'UIDDatPhong' => 'required',
        ]);
        $EmailKH = $request->input("email");
        $UIDDatPhong = $request->input("UIDDatPhong");

        $khachhang = Khachhang::findOrFail($EmailKH);
        $DDP = Dondatphong::findOrFail($UIDDatPhong);
        $ChiTietDonDatPhongs = Ctddp::where('MaDDP', $UIDDatPhong)->get();
        $renderBodyChiTietDonDatPhong = [];
        foreach ($ChiTietDonDatPhongs as $ChiTietDonDatPhong) {
            $loaiPhong = Loaiphong::findOrFail($ChiTietDonDatPhong->UIDLoaiPhong);
            $renderBodyChiTietDonDatPhong[] = [
                'TenLoaiPhong' => $loaiPhong->TenLoaiPhong,
                'SoNgayO' => $ChiTietDonDatPhong->SoNgayO,
                'soLuongPhong' => $ChiTietDonDatPhong->soLuongPhong,
                'Tien' => $ChiTietDonDatPhong->Tien,
            ];
        }


        if ($khachhang) {
            $renderbody = [
                'Email' => $khachhang->Email,
                'HoTen' => $khachhang->HoTen,
                'MaDDP' => $UIDDatPhong,
                'GiaTien' => $DDP->tongtien,
                'ChiTietDonDatPhong' => $renderBodyChiTietDonDatPhong,
            ];
            // return $renderbody;
            Mail::send('emails.statusdeclinedddp', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                $email->subject("Reservations Rejected");
                $email->to($EmailKH, $khachhang->HoTen);
            });
            return true;
        } else {
            return  response()->json(["message" => "eror"], 404);
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
        //
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
