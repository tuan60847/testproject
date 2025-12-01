<?php

namespace App\Http\Controllers;

use App\Models\Hinhanhk;
use App\Models\Khachsan;
use App\Models\Loaiphong;
use App\Models\Phongconlai;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use DB;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;

class KhachSanWebController extends Controller
{
    public function index()
    {
        $data = Khachsan::orderBy('isActive', 'asc')->get();
        return view('khachsan.index', ['data' => $data])->with('success', 'Khách sạn đã được kích hoạt thành công');
    }

    public function create(Khachsan $data)
    {
        return view('khachsan.create', ['data' => $data]);
    }

    public function findbyMaDDDL(string $id)
    {
        //
        $Khachsans =  Khachsan::where('MaDDDL', '=', $id)->orderByDesc('UIDKS')->get();
        $responseData = [];
        foreach ($Khachsans as $Khachsan) {
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

        return response()->json($responseData);
    }

    public function store(Request $request)
    {

        $data = new Khachsan();
        $data->TenKS = $request->TenKS;
        $data->DiaChi = $request->DiaChi;
        $data->Buffet = $request->Buffet;
        $data->Wifi = $request->Wifi;
        $data->isActive = $request->isActive;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();
        foreach ($request->file('image') as $img) {
            $imgPath = $img->store('khachsan', 'pulic');
            $imgData = new Hinhanhk;
            $imgData->UIDKS = $data->UIDKS;
            $imgData->src = 'image/' .  $imgPath;
            $imgData->save();
        }
        return redirect('admin/khachsan/create')->with('success', 'Thêm thành công');
    }

    public function show(string $id)
    {
        $data = Khachsan::find($id);
        return view('khachsan.show', ['data' => $data]);
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        $this->validate($request, [

            'TenKS' => 'required',
            'DiaChi' => 'required',
            // 'UIDKS' => 'required',
            'Buffet' => 'required',
            'Wifi' => 'required',
            'MaDDDL' => 'required',
        ]);
        $data = Khachsan::find($id);
        $data->TenKS = $request->TenKS;
        $data->DiaChi = $request->DiaChi;
        $data->Buffet = $request->Buffet;
        $data->Wifi = $request->Wifi;
       // $data->isActive = $request->isActive;
        $data->MaDDDL = $request->MaDDDL;
        $data->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $imgPath = $img->store('khachsan', 'public');
                $imgData = new Hinhanhk();
                $imgData->UIDKS = $data->UIDKS;
                $imgData->src = 'image/' .  $imgPath;
                $imgData->save();
            }
        }
        return redirect('adminKS/khachsan/findbyKS/' . $id . '/edit')->with('success', 'Khách sạn đã được cập nhật');
    }

    public function TimKhachSan(Request $request)
    {
        //

        $this->validate($request, [
            'Search' => 'required',
            'NgayDatPhong' => 'required|date_format:Y-m-d',
            'NgayTraPhong' => 'date_format:Y-m-d',
            // 'soGiuong'=> 'required',
            'SoLuongPhong' => 'required'
        ]);


        $Search = $request->input("Search");
        $NgayDatPhong = $request->input("NgayDatPhong");
        $NgayTraPhong = $request->input("NgayTraPhong");
        $soGiuong = $request->input("soGiuong");
        $SoLuongPhong = $request->input("SoLuongPhong");
        $khachSans = Khachsan::Where('DiaChi', 'LIKE', '%' . $Search . '%')
            ->where('isActive', true)
            ->get();
        $khachsantam = [];
        foreach ($khachSans as $khachsan) {
            $loaiphongs = Loaiphong::Where('UIDKS', '=', $khachsan->UIDKS)->get();

            foreach ($loaiphongs as $loaiphong) {
                if ($loaiphong->soGiuong == $soGiuong || $soGiuong == "") {
                    $phongconlai = Phongconlai::Where('UIDLoaiPhong', '=', $loaiphong->UIDLoaiPhong)->Where('Ngay', '=', $NgayDatPhong)->first();
                    if (!$phongconlai) {
                        if ($loaiphong->soLuongPhong > intval($SoLuongPhong)) {
                            $khachsantam[] = $khachsan;
                            break;
                        }
                    } else if ($phongconlai->SoLuong > intval($SoLuongPhong)) {
                        $khachsantam[] = $khachsan;
                        break;
                    }
                }
            }
        }
        $responseData = [];
        foreach ($khachsantam as $Khachsan) {
            $responseData[] = [
                'UIDKS' => $Khachsan->UIDKS,
                'TenKS' => $Khachsan->TenKS,
                'DiaChi' => $Khachsan->DiaChi,
                'SDT' => $Khachsan->SDT,
                'MaDDDL' => $Khachsan->MaDDDL,
                'Wifi' => boolval($Khachsan->Wifi),
                'Buffet' => boolval($Khachsan->Buffet),
                'isActive' => boolval($Khachsan->isActive),
                'taxCode' => $Khachsan->taxcode,
            ];
        }

        return response()->json($responseData);

        // $isAdminKH ="isAdminKH";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $khachsan = Khachsan::findORFail($id);
        $khachsan->isActive = false;
        return $khachsan->update();
    }
    public function getks(String $id)
    {
        $data = Khachsan::where('UIDKS', $id)->get();
        $responseData = [];

        foreach ($data as $d) {
            $responseData[] = [
                'UIDKS' => $d->UIDKS,
                'TenKS' => $d->TenKS,
                'DiaChi' => $d->DiaChi,
                'SDT' => $d->SDT,
                'Buffet' => $d->Buffet,
                'Wifi' => $d->Wifi,
                'MaDDDL' => $d->MaDDDL,
                'taxcode' => $d->taxcode,
            ];
        }

        return view('taikhoanKS.index', ['data' => $data]);
        // return redirect('adminKS/loaiphong/findbyKS/' . $loaiphong->UIDKS);
    }
    public function showKS(String $UIDKS)
    {
        $data = Khachsan::where('UIDKS', '=', $UIDKS)->first();
        // return $loaiphong;
        return view('taikhoanKS.show', ['data' => $data]);
    }
    public function editKS(String $id)
    {
        $data = Khachsan::find($id);
        return view('taikhoanKS.edit', ['data' => $data]);
    }


    public function checkTaxcode(String $UIDKS)
    {
        session()->flash('success', 'Cập nhật thành công.');
        $khachsan = Khachsan::findOrFail($UIDKS);
        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);
        try {
            $Uri = "https://api.vietqr.io/v2/business/" . $khachsan->taxcode;
            $response = $client->get($Uri); // Thay thế URL bằng URL của API bạn muốn gọi
            $data = $response->getBody()->getContents();

            // Xử lý dữ liệu từ API (ví dụ: chuyển đổi JSON thành mảng)
            $dataArray = json_decode($data, true);

            // Xử lý dữ liệu theo nhu cầu của bạn
            // ...
            // return $dataArray;
            if ($dataArray['desc'] == '00') {
                $data = Khachsan::orderBy('isActive', 'asc')->get();
                session()->flash('success', 'Kích hoạt khách sạn thành công');
                return view('khachsan.index', ['data' => $data])->with('success', 'Kích hoạt khách sạn thành công');
                //Ghi hiện thông tin $dataArray['data'].['name'];
            } else {
                $data = Khachsan::orderBy('isActive', 'asc')->get();
                session()->flash('success', 'Chưa có khách sạn này');
                return view('khachsan.index', ['data' => $data])->with('success', 'Chưa có khách sạn này');
                //Ghi kèm thông báo chưa có
            }
            // return response()->json($dataArray);
            // return view('taikhoanKS.edit', ['data' => $khachsan]);
        } catch (ClientException $e) {
            // Kèm Thông báo lỗi 505
            $data = Khachsan::orderBy('isActive', 'asc')->get();
            session()->flash('success', 'Thông báo lỗi 505');
            return view('khachsan.index', ['data' => $data])->with('success', 'Thông báo lỗi 505');
        } catch (RequestException $e) {
            // Xử lý lỗi RequestException (ví dụ: không thể kết nối tới server)
            //kèm thông báo lỗi RequestException
            $data = Khachsan::orderBy('isActive', 'asc')->get();
            session()->flash('success', 'thông báo lỗi RequestException');
            return view('khachsan.index', ['data' => $data])->with('success', 'thông báo lỗi RequestException');
        } catch (Exception $e) {
            // Xử lý các lỗi khác
            // return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
            //Kèm thông báo lỗi e->getMessage()
            $data = Khachsan::orderBy('isActive', 'asc')->get();
            session()->flash('success', 'thông báo lỗi Message');
            return view('khachsan.index', ['data' => $data])->with('success', 'thông báo lỗi Message');
        }
    }

    public function changeActive(String $UIDKS)
    {
        $khachsan = Khachsan::findOrFail($UIDKS);
        if ($khachsan) {
            $khachsan->isActive = !$khachsan->isActive;
            $khachsan->update();
        }

        $data = Khachsan::orderBy('isActive', 'asc')->get();
        return view('khachsan.index', ['data' => $data]);
    }
    public function destroy_image($src)
    {
        $hinhanhk = Hinhanhk::findOrFail("image/khachsan/" . $src);
        Storage::disk('public')->delete($hinhanhk->src);
        $hinhanhk->delete();
        // return response(null, Response::HTTP_NO_CONTENT);
        return redirect('/adminKS/khachsan/findbyKS/' . $hinhanhk->UIDKS . '/edit');
    }
}
