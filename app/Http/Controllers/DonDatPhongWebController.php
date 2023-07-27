<?php

namespace App\Http\Controllers;

use App\Models\Ctddp;
use App\Models\Dondatphong;
use App\Models\Khachhang;
use App\Models\Loaiphong;
use App\Models\Phongconlai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class DonDatPhongWebController extends Controller
{
    public function index()
    {
        $dondatphong = Dondatphong::all();
        return view('dondatphong.index', ['dondatphong' => $dondatphong]);
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
            'UIDDatPhong' => 'required',
            'EmailKH' => 'required',
            'NgayDatPhong' => 'required|date_format:Y-m-d',
            'isChecked' => 'required',
            'TienCoc' => 'required',
            'tongtien' => 'required',


        ]);


        $UIDDatPhong = $request->input("UIDDatPhong");
        $EmailKH = $request->input("EmailKH");
        $NgayDatPhong = $request->input("NgayDatPhong");


        $TienCoc = $request->input("TienCoc");
        $tongtien = $request->input("tongtien");

        $isChecked = $request->input("isChecked");




        if (!empty($UIDDatPhong)) {

            $dondatphong = new Dondatphong();
            $dondatphong->UIDDatPhong = $UIDDatPhong;
            $dondatphong->EmailKH = $EmailKH;
            $dondatphong->NgayDatPhong = $NgayDatPhong;
            $dondatphong->TienCoc = $TienCoc;
            $dondatphong->tongtien = $tongtien;
            $dondatphong->isChecked = $isChecked;


            $dondatphong->save();



            return response($dondatphong, Response::HTTP_CREATED);
        } else {
            // handle the case where the image upload fails
            // e.g. return an error response or redirect back to the form with an error message
            return response()->json(["message" => "eror"], 404);
        }
    }

    public function findDDPprocess(string $UIDKS)
    {

        return Dondatphong::whereNotIn('isChecked', [0, 5, 6, 7, 8])->Where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get();
    }

    public function findHistoryDDPByCKS(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        return Dondatphong::where('isChecked', 5)
            ->orWhereIn('isChecked', [6, 7, 8])
            ->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')
            ->get();
    }

    public function findHistoryDDPByKH(Request $request)
    {
        $this->validate($request, [
            'EmailKH' => 'required',
        ]);
        $EmailKH = $request->input("EmailKH");
        return Dondatphong::where('isChecked', 5)
            ->orWhereIn('isChecked', [6, 7, 8])
            ->where('EmailKH', $EmailKH)
            ->get();
    }



    public function lastItemByEmail(string $EmailKH)
    {
        $DonDatPhong = Dondatphong::where('EmailKH', $EmailKH)->orderBy('isChecked', 'asc')->get();
        return $DonDatPhong->first();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $DonDatPhong = Dondatphong::find($id);
        return view('dondatphong.show', ['dondatphong' => $DonDatPhong]);
        // return Dondatphong::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dondatphong = Dondatphong::find($id);
        return view('dondatphong.edit', ['dondatphong' => $dondatphong]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dondatphong = Dondatphong::findOrFail($id);

        $isChecked = $request->input("isChecked");
        // if (!empty($dondatphong)) {
        //     $dondatphong->isChecked = $isChecked;
        //     $dondatphong->update();
        //     return redirect('/adminKS/dondatphong')->with('success', 'Đơn đặt phòng đã được cập nhật');
        // } else {
        //     return response()->json(["message" => "eror"], 404);
        // }
        // return redirect('/adminKS/dondatdat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng đã được cập nhật');
        // $UIDKS = $request->input("UIDKS");
        if ($isChecked == 2 && $dondatphong->isChecked != 2) {
            $UIDDatPhong = $dondatphong->UIDDatPhong;
            // $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
            $Ngay = $dondatphong->NgayDatPhong;
            $ArrayMaxRoom = [];
            $Date = Carbon::createFromFormat('Y-m-d', $Ngay);
            $startDate =  $Date->addDays(0)->format('Y-m-d');
            $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
            foreach ($chitietdondatphong as $item) {
                $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);
                $MaxRoom = $loaiphong->soLuongPhong;
                $endDate =  $Date->copy()->addDays(intval($item->SoNgayO))->format('Y-m-d');
                $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->orderBy('SoLuong', 'asc')
                    ->first();
                if (!empty($phongconlai)) {
                    $ArrayMaxRoom[] = $phongconlai->SoLuong;
                } else {
                    $ArrayMaxRoom[] = $MaxRoom;
                }
            }

            for ($i = 0; $i < count($chitietdondatphong); $i++) {
                if ($ArrayMaxRoom[$i] < $chitietdondatphong[$i]->soLuongPhong) {
                    return redirect('adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng đã đầy không thể đặt thêm');
                }
            }

            foreach ($chitietdondatphong as $item) {
                $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

                for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                    $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                    $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                        ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                        ->first();

                    if (empty($phongconlai)) {
                        $phongconlai = new Phongconlai();
                        $phongconlai->Ngay = $NgayTam;
                        $phongconlai->UIDLoaiPhong = $item->UIDLoaiPhong;


                        if ($loaiphong->soLuongPhong >= $item->soLuongPhong) {
                            $phongconlai->SoLuong = $loaiphong->soLuongPhong - $item->soLuongPhong;

                            $phongconlai->save();
                        }
                    } else {
                        if ($phongconlai->SoLuong >= $item->soLuongPhong) {
                            $phongconlai->SoLuong = $phongconlai->SoLuong - $item->soLuongPhong;

                            $phongconlai->update();
                        }
                    }
                }
            }
            $dondatphong->isChecked = 2;
            $dondatphong->TienCoc = $dondatphong->tongtien * 30 / 100;
            $dondatphong->update();
            $khachhang = Khachhang::findOrFail($dondatphong->EmailKH);
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
                    'GiaTien' => $dondatphong->tongtien,
                    'TraTruoc' => $dondatphong->tongtien * 30 / 100,
                    'ConLai' =>  $dondatphong->tongtien * 70 / 100,
                    'ChiTietDonDatPhong' => $renderBodyChiTietDonDatPhong,
                ];
                $EmailKH =  $dondatphong->EmailKH;
                // return $renderbody;
                Mail::send('emails.statusddp', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                    $email->subject("Booking Invoice");
                    $email->to($EmailKH, $khachhang->HoTen);
                });
            }
            $dondatphong->isChecked = $isChecked;
            $dondatphong->update();
            return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng đã được cập nhật');
        } elseif ($isChecked == 7) {

            if ($dondatphong->isChecked > 1 && $dondatphong->isChecked < 4) {
                if ($dondatphong->TienCoc != 0) {
                    return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng không được phép hủy');
                } elseif ($dondatphong->TienCoc = 0) {
                    $Ngay = $dondatphong->NgayDatPhong;

                    $Date = Carbon::createFromFormat('Y-m-d', $Ngay);

                    $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
                    foreach ($chitietdondatphong as $item) {
                        $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

                        for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                            $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                            $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                                ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                                ->first();

                            if (!empty($phongconlai)) {
                                if ($phongconlai->SoLuong + $item->soLuongPhong <= $loaiphong->soLuongPhong) {
                                    $phongconlai->SoLuong = $phongconlai->SoLuong + $item->soLuongPhong;
                                    $phongconlai->update();
                                } else {
                                    return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đã hủy đơn đặt phòng');
                                }
                            } else {
                                return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đã hủy đơn đặt phòng');
                            }
                        }
                    }

                    return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đã hủy đơn đặt phòng');
                }
            }
            $UIDDatPhong = $dondatphong->UIDDatPhong;
            $khachhang = Khachhang::findOrFail($dondatphong->EmailKH);
            $ChiTietDonDatPhongs = Ctddp::where('MaDDP', $UIDDatPhong)->get();
            // return $ChiTietDonDatPhongs;
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
                    'GiaTien' => $dondatphong->tongtien,
                    'TraTruoc' => $dondatphong->tongtien * 30 / 100,
                    'ConLai' =>  $dondatphong->tongtien * 70 / 100,
                    'ChiTietDonDatPhong' => $renderBodyChiTietDonDatPhong,
                ];
                $EmailKH =  $dondatphong->EmailKH;
                Mail::send('emails.statusddp', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                    $email->subject("Cancel Invoice");
                    $email->to($EmailKH, $khachhang->HoTen);
                });
            }
            $dondatphong->isChecked = $isChecked;
            $dondatphong->update();
            return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng đã được cập nhật');
        } else {
            $dondatphong->isChecked = $isChecked;
            $dondatphong->update();
            return redirect('/adminKS/dondadat/findbyKS/' . $dondatphong->UIDDatPhong)->with('success', 'Đơn đặt phòng đã được cập nhật');
        }
    }

    public function destroy(string $id)
    {
        //
        return Dondatphong::destroy($id);
    }

    public function AcceptDonDatPhong(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;
        $ArrayMaxRoom = [];
        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);
        $startDate =  $Date->addDays(0)->format('Y-m-d');
        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);
            $MaxRoom = $loaiphong->soLuongPhong;
            $endDate =  $Date->copy()->addDays(intval($item->SoNgayO))->format('Y-m-d');
            $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
                ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                ->orderBy('SoLuong', 'asc')
                ->first();
            if (!empty($phongconlai)) {
                $ArrayMaxRoom[] = $phongconlai->SoLuong;
            } else {
                $ArrayMaxRoom[] = $MaxRoom;
            }
        }

        for ($i = 0; $i < count($chitietdondatphong); $i++) {
            if ($ArrayMaxRoom[$i] < $chitietdondatphong[$i]->soLuongPhong) {
                $dondatphongtam = Dondatphong::whereIn('isChecked', [0, 1, 2])->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get();
                return view('dondatphong.index', ['dondatphong' => $dondatphongtam])->with('message', 'Xác nhận không thành công yêu cầu đổi phòng hoặc hủy');
            }
        }

        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (empty($phongconlai)) {
                    $phongconlai = new Phongconlai();
                    $phongconlai->Ngay = $NgayTam;
                    $phongconlai->UIDLoaiPhong = $item->UIDLoaiPhong;


                    if ($loaiphong->soLuongPhong >= $item->soLuongPhong) {
                        $phongconlai->SoLuong = $loaiphong->soLuongPhong - $item->soLuongPhong;

                        $phongconlai->save();
                    }
                } else {
                    if ($phongconlai->SoLuong >= $item->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong - $item->soLuongPhong;

                        $phongconlai->update();
                    }
                }
            }
        }
        $dondatphong->isChecked = 2;
        $dondatphong->TienCoc = $dondatphong->tongtien * 30 / 100;
        $dondatphong->update();
        $khachhang = Khachhang::findOrFail($dondatphong->EmailKH);
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
                'GiaTien' => $dondatphong->tongtien,
                'TraTruoc' => $dondatphong->tongtien * 30 / 100,
                'ConLai' =>  $dondatphong->tongtien * 70 / 100,
                'ChiTietDonDatPhong' => $renderBodyChiTietDonDatPhong,
            ];
            $EmailKH =  $dondatphong->EmailKH;
            // return $renderbody;
            Mail::send('emails.statusddp', ['renderbody' => $renderbody], function ($email) use ($EmailKH, $khachhang) {
                $email->subject("Booking Invoice");
                $email->to($EmailKH, $khachhang->HoTen);
            });
        }

        $dondatphong->update();
        $dondatphongtam = Dondatphong::whereIn('isChecked', [0, 1, 2])->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get();
        return view('dondatphong.index', ['dondatphong' => $dondatphongtam])->with('message', 'Xác nhận thành công ');
    }


    public function CancelDonDatPhongByUser(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;

        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);

        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (!empty($phongconlai)) {
                    if ($phongconlai->SoLuong + $item->soLuongPhong <= $loaiphong->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong + $item->soLuongPhong;
                        $phongconlai->update();
                    } else {
                        return response()->json(["message" => "eror"], 404);
                    }
                } else {
                    return response()->json(["message" => "eror"], 404);
                }
            }
        }
        $dondatphong->isChecked = 6;

        return response()->json($dondatphong->update());
    }

    public function CancelDonDatPhongByChuKhachSan(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        $UIDDatPhong = $request->input("UIDDatPhong");
        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $Ngay = $dondatphong->NgayDatPhong;

        $Date = Carbon::createFromFormat('Y-m-d', $Ngay);

        $chitietdondatphong = Ctddp::where('MaDDP', $dondatphong->UIDDatPhong)->get();
        foreach ($chitietdondatphong as $item) {
            $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

            for ($i = 0; $i <= intval($item->SoNgayO); $i++) {
                $NgayTam = $Date->copy()->addDays($i)->format('Y-m-d');
                $phongconlai = Phongconlai::where('Ngay', $NgayTam)
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->first();

                if (!empty($phongconlai)) {
                    if ($phongconlai->SoLuong + $item->soLuongPhong <= $loaiphong->soLuongPhong) {
                        $phongconlai->SoLuong = $phongconlai->SoLuong + $item->soLuongPhong;
                        $phongconlai->update();
                    } else {
                        return response()->json(["message" => "eror"], 404);
                    }
                } else {
                    return response()->json(["message" => "eror"], 404);
                }
            }
        }
        $dondatphong->isChecked = 7;
        $dondatphong->update();
        return response()->json($dondatphong);
    }
    // public function checkDonDatPhong(Request $request)
    // {
    //     $this->validate($request, [
    //         'UIDKS' => 'required',
    //     ]);
    //     $UIDKS = $request->input("UIDKS");
    //     $statuses = [
    //         1 => 'Xác nhận của khách hàng',
    //         2 => 'Xác nhận của khách sạn',
    //         3 => 'Check in',
    //         4 => 'Check out',
    //     ];
    //     $searchValues = ['Đã xác nhận', 'Xác nhận của khách hàng'];

    //     $foundIndexes = [];
    //     foreach ($searchValues as $searchValue) {
    //         $foundIndex = array_search($searchValue, $statuses);
    //         if ($foundIndex !== false) {
    //             $foundIndexes[] = $foundIndex;
    //         }
    //     }


    //     if ($dondatphong = Dondatphong::whereIn('isChecked', [0, 1, 2])->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get()) {
    //         return view('dondatphong.index', ['dondatphong' => $dondatphong]);
    //     }
    // }


    public function dondangdienra(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        $statuses = [
            1 => 'Đã xác nhận',
            2 => 'Xác nhận của khách hàng',
            3 => 'Check in',
            4 => 'Check out',
            5 => 'Hoàn thành',
            6 => 'Khách hàng yêu cầu hủy',
            7 => 'Khách sạn yêu cầu hủy',
            8 => 'Hoàn thành từ chối',
        ];
        if ($dondatphong = Dondatphong::where('isChecked', 3)->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get()) {
            return view('dondatphong.dondahoanthanh', ['dondatphong' => $dondatphong]);
        }
    }
    public function dondahuy(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        $statuses = [
            1 => 'Đã xác nhận',
            2 => 'Xác nhận của khách hàng',
            6 => 'Người dùng đã hủy',
            7 => 'Khách sạn đã hủy',
        ];
        $searchValues = ['Người dùng đã hủy', 'Khách sạn đã hủy'];

        $foundIndexes = [];
        foreach ($searchValues as $searchValue) {
            $foundIndex = array_search($searchValue, $statuses);
            if ($foundIndex !== false) {
                $foundIndexes[] = $foundIndex;
            }
        }

        $dondatphong = Dondatphong::whereIn('isChecked', $foundIndexes)->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get();

        if ($dondatphong->count() > 0) {
            return view('dondatphong.dondahuy', ['dondatphong' => $dondatphong]);
        }
    }
    public function lichsu(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);
        $UIDKS = $request->input("UIDKS");
        $statuses = [
            0 => 'Chưa xác nhận',
            1 => 'Xác nhận của khách hàng',
            2 => 'Xác nhận của khách sạn',
            3 => 'Check in',
            4 => 'Check out',
            5 => 'Hoàn thành',
            6 => 'Khách hàng yêu cầu hủy',
            7 => 'Khách sạn yêu cầu hủy',
            8 => 'Hoàn thành từ chối',
        ];
        if ($dondatphong = Dondatphong::where('isChecked', 5)->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get()) {
            return view('dondatphong.lichsu', ['dondatphong' => $dondatphong]);
        }
    }
    public function checkDonDatPhong(Request $request)
    {
        $this->validate($request, [
            'UIDKS' => 'required',
        ]);

        $UIDKS = $request->input("UIDKS");
        $dondatphong = Dondatphong::whereIn('isChecked', [0, 1, 2])->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->get();
        $enoughRooms = true;

        foreach ($dondatphong as $dondat) {
            $chitietdondatphong = Ctddp::where('MaDDP', $dondat->UIDDatPhong)->get();
            foreach ($chitietdondatphong as $item) {
                $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);

                $startDate = Carbon::createFromFormat('Y-m-d', $dondat->NgayDatPhong);
                $endDate = $startDate->copy()->addDays(intval($item->SoNgayO));

                $phongconlai = Phongconlai::whereBetween('Ngay', [$startDate, $endDate])
                    ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
                    ->orderBy('SoLuong', 'asc')
                    ->first();

                if ($phongconlai) {
                    $soPhongConLai = $phongconlai->SoLuong;
                } else {
                    $soPhongConLai = $loaiphong->soLuongPhong;
                }

                if ($soPhongConLai < $item->soLuongPhong) {
                    $enoughRooms = false;
                    break;
                }
            }
            if (!$enoughRooms) {
                break;
            }
            if ($enoughRooms) {

                $dondatphong->isChecked = 2;
                Dondatphong::whereIn('isChecked', [0, 1, 2])->where('UIDDatPhong', 'LIKE', '%' . $UIDKS . '%')->update(['isChecked' => 2]);

                return view('dondatphong.index', ['dondatphong' => $dondatphong])->with('message', 'Đã xác nhận đơn đặt phòng thành công.');
            } else {
                return view('dondatphong.index', ['dondatphong' => $dondatphong])->with('message', 'Xác nhận không thành công yêu cầu đổi phòng hoặc hủy');
            }
        }
        return view('dondatphong.index', ['dondatphong' => $dondatphong])->with('message', 'Xác nhận không thành công yêu cầu đổi phòng hoặc hủy');
    }
    // public function lichsu(Request $request)
    // {
    //     $this->validate($request, [
    //         'UIDDatPhong' => 'required',
    //     ]);

    //     $UIDDatPhong = $request->input('UIDDatPhong');
    //     $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
    //     $chitietdondatphong = Ctddp::where('MaDDP', $UIDDatPhong)->get();
    //     foreach ($chitietdondatphong as $item) {
    //         $loaiphong = Loaiphong::findOrFail($item->UIDLoaiPhong);
    //         $startDate = Carbon::createFromFormat('Y-m-d', $item->Ngay);
    //         $endDate = $startDate->copy()->addDays($item->SoNgayO);

    //         for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //             $ngayTam = $date->format('Y-m-d');
    //             $phongconlai = Phongconlai::where('Ngay', $ngayTam)
    //                 ->where('UIDLoaiPhong', $item->UIDLoaiPhong)
    //                 ->first();

    //             if (empty($phongconlai)) {
    //                 $phongconlai = new Phongconlai();
    //                 $phongconlai->Ngay = $ngayTam;
    //                 $phongconlai->UIDLoaiPhong = $item->UIDLoaiPhong;
    //                 $phongconlai->SoLuong = $loaiphong->soLuongPhong;
    //                 $phongconlai->save();
    //             } else {
    //                 $phongconlai->SoLuong += $item->soLuongPhong;
    //                 $phongconlai->update();
    //             }
    //         }
    //     }
    //     $dondatphong->isChecked = 5;
    //     $dondatphong->save();
    //     return view('dondatphong.lichsu')->with('message', 'Hoàn thành đơn đặt phòng thành công.');
    // }
}
