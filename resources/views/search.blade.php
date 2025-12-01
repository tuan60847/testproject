@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tìm kiếm</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tìm kiếm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($thanhphos && count($thanhphos) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã thành phố</th>
                            <th>Tên thành phố</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã thành phố</th>
                            <th>Tên thành phố</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if( $thanhphos )
                        @foreach( $thanhphos as $d)
                        <tr>
                            <td>{{$d->MaTP}}</td>
                            <td>{{$d->TenTP}}</td>
                            <td>{{Str::limit($d->mota,30)}}</td>
                            <td>{{count($d->hinhanhtps)}}</td>
                            <td>
                                <a href="{{url('admin/thanhpho/'.$d->MaTP)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('admin/thanhpho/'.$d->MaTP.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <!-- <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/thanhpho/'.$d->MaTP.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($diadiemdulichs && count($diadiemdulichs) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Địa điểm du lịch</th>
                            <th>Tên Địa điểm du lịch</th>
                            <th>Địa chỉ</th>
                            <th>Mô tả</th>
                            <th>Thời gian hoạt động</th>
                            <th>Giá vé</th>
                            <th>Mã thành phố</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã Địa điểm du lịch</th>
                            <th>Tên Địa điểm du lịch</th>
                            <th>Địa chỉ</th>
                            <th>Mô tả</th>
                            <th>Thời gian hoạt động</th>
                            <th>Giá vé</th>
                            <th>Mã thành phố</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($diadiemdulichs )
                        @foreach($diadiemdulichs as $d)
                        <tr>
                            <td>{{$d->MaDDDL}}</td>
                            <td>{{$d->TenDiaDiemDuLich}}</td>
                            <td>{{Str::limit($d->DiaChi,5)}}</td>
                            <td>{{Str::limit($d->MoTa,10)}}</td>
                            <td>{{$d->ThoiGianHoatDong}}</td>
                            <td>{{$d->GiaTien}}</td>
                            <td>{{$d->MaTP}}</td>
                            <td>{{count($d->hinhanhdddls)}}</td>
                            <td>
                                <a href="{{url('admin/diadiemdulich/'.$d->MaDDDL)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('admin/diadiemdulich/'.$d->MaDDDL.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/diadiemdulich/'.$d->MaDDDL.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($sukiens && count($sukiens) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>Mã sự kiện</th>
                            <th>Tên sự kiện</th>
                            <th>Mô tả</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mã địa điểm du lịch</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã sự kiện</th>
                            <th>Tên sự kiện</th>
                            <th>Mô tả</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mã địa điểm du lịch</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($sukiens )
                        @foreach($sukiens as $d)
                        <tr>
                            <td>{{$d->maSuKien}}</td>
                            <td>{{Str::limit($d->TenSuKien,20)}}</td>
                            <td>{{Str::limit($d->MoTa,20)}}</td>
                            <td>{{$d->NgayBatDau}}</td>
                            <td>{{$d->NgayKetThuc}}</td>
                            <td>{{$d->MaDDDL}}</td>
                            <td>{{count($d->hinhanhsukiens)}}</td>
                            <td>
                                <a href="{{url('admin/sukien/'.$d->maSuKien)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('admin/sukien/'.$d->maSuKien.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/sukien/'.$d->maSuKien.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($khachSans && count($khachSans) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Khách sạn</th>
                            <th>Tên Khách sạn</th>
                            <th>Địa chỉ</th>
                            <th>SDT</th>
                            <th>Buffet</th>
                            <th>Wifi</th>
                            <th>MaDDDL</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã Khách sạn</th>
                            <th>Tên Khách sạn</th>
                            <th>Địa chỉ</th>
                            <th>SDT</th>
                            <th>Buffet</th>
                            <th>Wifi</th>
                            <th>MaDDDL</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($khachSans )
                        @foreach($khachSans as $d)
                        <tr>
                            <td>{{$d->UIDKS}}</td>
                            <td>{{$d->TenKS}}</td>
                            <td>{{$d->DiaChi}}</td>
                            <td>{{$d->SDT}}</td>
                            <td>{{$d->Buffet}}</td>
                            <td>{{$d->Wifi}}</td>
                            <td>{{$d->MaDDDL}}</td>
                            <td>{{count($d->hinhanhks)}}</td>
                            <td>
                                <a href="{{url('admin/khachsan/'.$d->UIDKS)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <!-- <a href="{{url('admin/khachsan/'.$d->UIDKS.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a> -->
                                <!-- <a onclick="confirm('Bạn có chắc muốn xóa khách sạn này?')" href="{{url('admin/khachsan/'.$d->UIDKS.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($khachhangs && count($khachhangs) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Họ và Tên</th>
                            <th>Ngày sinh</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>CMNND/CCCD</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Họ và Tên</th>
                            <th>Ngày sinh</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>CMNND/CCCD</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($khachhangs )
                        @foreach($khachhangs as $d)
                        <tr>
                            <td>{{$d->HoTen}}</td>
                            <td>{{$d->NgaySinh}}</td>
                            <td>{{$d->SDT}}</td>
                            <td>{{$d->Email}}</td>
                            <td>{{$d->cmnd}}</td>
                            <td>
                                <a href="{{url('admin/khtiemnang/'.$d->Email)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <!-- <a href="{{url('admin/sukien/'.$d->maSuKien.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/sukien/'.$d->maSuKien.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($chukhachsans && count($chukhachsans) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ADMINKS</th>
                            <th>Họ và Tên</th>
                            <th>Ngày sinh</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>CMNND/CCCD</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ADMINKS</th>
                            <th>Họ và Tên</th>
                            <th>Ngày sinh</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>CMNND/CCCD</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($chukhachsans)
                        @foreach($chukhachsans as $d)
                        @if($d->ADMINKS != '1')
                        <tr>
                            <td>{{$d->ADMINKS}}</td>
                            <td>{{$d->HoTen}}</td>
                            <td>{{$d->NgaySinh}}</td>
                            <td>{{$d->SDT}}</td>
                            <td>{{$d->Email}}</td>
                            <td>{{$d->cmnd}}</td>

                            <td>
                                <a href="{{url('admin/khthanthiet/'.$d->Email)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <!-- <a href="{{url('admin/sukien/'.$d->maSuKien.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/sukien/'.$d->maSuKien.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
@section('script')
<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
@endsection