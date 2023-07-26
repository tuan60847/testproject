<?php

namespace App\Http\Controllers;

use App\Models\Dondatphong;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class VnpayController extends Controller
{

    public function PaymentVNpay(Request $request)
    {
        $this->validate($request, [
            'UIDDatPhong' => 'required',
        ]);
        // return 1;

        $UIDDatPhong = $request->input("UIDDatPhong");

        $dondatphong = Dondatphong::findOrFail($UIDDatPhong);
        $requestIP = Request::capture();
        $currentIP = $requestIP->ip();
        // return $dondatphong;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://".$currentIP.":8000/api/acceptdondatphongget/".$UIDDatPhong;
        $vnp_TmnCode = "C3PB8HH3"; //Mã website tại VNPAY
        $vnp_HashSecret = "OHHVUBHTNAMJUDEYECZKBGRAQNWQPOIV"; //Chuỗi bí mật

        $vnp_TxnRef = $UIDDatPhong;
        $vnp_OrderInfo = 'Thanh Toán Test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = ($dondatphong->tongtien*30/100) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        // try {
        //     // Thực hiện chuyển hướng đến $vnp_Url
        //     return redirect($vnp_Url);
        // } catch (Exception $e) {
        //     // Xử lý ngoại lệ bằng cách ghi log lỗi hoặc hiển thị thông báo lỗi cho người dùng
        //     Log::error('Error occurred during redirection: ' . $e->getMessage());
        //     // Hiển thị thông báo lỗi cho người dùng
        //     return redirect()->back()->with('error', 'An error occurred during redirection. Please try again later.');
        // }


        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url, true, 302); // Hoặc 302 nếu cần
            exit();
        } else {
            echo json_encode($returnData);
            // return $returnData;
        }


        // return  header('Location: ' . $vnp_Url);
        // Trả về view với dữ liệu cần thiết để hiển thị thanh toán VNPAY
        // return $vnp_Url;
    }



    public function LinkVnPAy(string $UIDDDP)
    {
        //
        $request = Request::capture();
        $currentIP = $request->ip();
        $PaymentLink = 'http://' . $currentIP . ':8000/api/vnpay/';
        $renderbody = [
            'UIDDatPhong' => $UIDDDP,
            'PaymentLink' => $PaymentLink
        ];

        // return $renderbody;
        // Trả về view và truyền dữ liệu tới view
        return view('thanhtoanvnpay.link', compact('renderbody'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
