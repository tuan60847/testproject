@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Đơn đặt phòng</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đơn đặt phòng
                <a href="{{url('/adminKS/dondatphong/create')}}" class="float-right btn-primary btn-sm">Thêm mới</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            <th>Thao tác</th>
                            <th>Trạng thái</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($dondatphong )
                        @foreach($dondatphong as $d)
                        <tr>
                            <td>{{Str::limit($d->UIDDatPhong, 10)}}</td>
                            <td>{{$d->EmailKH}}</td>
                            <td>{{$d->NgayDatPhong}}</td>
                            <td>{{$d->TienCoc}}</td>
                            <td>{{$d->tongtien}}</td>
                            <td>{{$d->isChecked==3?"Khách đã nhận phòng":"Khong co"}}</td>

                            <td>
                                <a href="{{url('adminKS/dondatphong/'.$d->UIDDatPhong)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('adminKS/dondatphong/'.$d->UIDDatPhong.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa loại phòng này?')" href="{{url('admin/loaiphong/'.$d->UIDLoaiPhong.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
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