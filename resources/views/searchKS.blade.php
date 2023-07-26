@extends('layoutKS')
@section('content')
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
                @if ($dondatphongs && count($dondatphongs) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đặt phòng</th>
                            <th>Email</th>
                            <th>Ngày đặt phòng</th>
                            <th>Tiền cọc</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã đặt phòng</th>
                            <th>Email</th>
                            <th>Ngày đặt phòng</th>
                            <th>Tiền cọc</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($dondatphongs )
                        @foreach($dondatphongs as $d)
                        <tr>
                            <td>{{Str::limit($d->UIDDatPhong, 10)}}</td>
                            <td>{{$d->EmailKH}}</td>
                            <td>{{$d->NgayDatPhong}}</td>
                            <td>{{$d->TienCoc}}</td>
                            <td>{{number_format($d->tongtien, 0, ',', '.')}}</td>
                            <td>@if($d->isChecked==0) Chưa xác nhận
                                @elseif($d->isChecked==1) Đã xác nhận
                                @elseif($d->isChecked==3) Khách đã nhận phòng
                                @elseif($d->isChecked==5) Đơn đã hoàn thành
                                @elseif($d->isChecked==6) Đơn đã bị hủy
                                @elseif($d->isChecked==7) Khách sạn hủy phòng
                                @endif</td>

                            <td>
                                <a href="{{url('adminKS/dondadat/findbyKS/'.$d->UIDDatPhong)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('adminKS/dondatphong/'.$d->UIDDatPhong.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <!-- <a onclick="confirm('Bạn có chắc muốn xóa loại phòng này?')" href="{{url('admin/loaiphong/'.$d->UIDLoaiPhong.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
            <div class="table-responsive">
                @if ($loaiphongs && count($loaiphongs) > 0)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã loại</th>
                            <th>Tên loại phòng</th>
                            <th>Máy lạnh</th>
                            <th>Số giường</th>
                            <th>Giá phòng</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã loại</th>
                            <th>Tên loại phòng</th>
                            <th>Máy lạnh</th>
                            <th>Số giường</th>
                            <th>Giá phòng</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @if($loaiphongs)
                        @foreach($loaiphongs as $d)
                        <tr>
                            <td>{{$d->UIDLoaiPhong}}</td>
                            <td>{{$d->TenLoaiPhong}}</td>
                            <td>{{$d->isMayLanh}}</td>
                            <td>{{$d->soGiuong}}</td>
                            <td>{{$d->Gia}}</td>
                            <td>{{$d->soLuongPhong}}</td>
                            <td>{{count($d->hinhanhloaiphongs)}}</td>
                            <td>
                                <a href="{{url('adminKS/loaiphong/findbyKS/'.$d->UIDLoaiPhong.'/show')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('adminKS/loaiphong/findbyKS/'.$d->UIDLoaiPhong.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

                                <a onclick="confirm('Bạn có chắc muốn xóa loại phòng này?')" href="{{url('adminKS/loaiphong/findbyKS/'.$d->UIDKS.'/'.$d->UIDLoaiPhong.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
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