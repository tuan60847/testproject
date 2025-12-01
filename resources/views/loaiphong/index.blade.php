@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Loại phòng</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Loại phòng
                <a @if(Session::has('cksData')) href="{{url('/adminKS/loaiphong/findbyKS/'.Session::get('cksData')->ADMINKS.'/create')}}" @endif class="float-right btn-primary btn-sm">Thêm mới</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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

                        @if($loaiphong)
                        @foreach($loaiphong as $d)
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

                                <!-- <a onclick="confirm('Bạn có chắc muốn xóa loại phòng này?')" @if(Session::has('cksData')) href="{{url('adminKS/loaiphong/findbyKS/'.Session::get('cksData')->ADMINKS.'/delete/'.$d->UIDLoaiPhong)}}" @endif class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                                <a onclick="confirm('Bạn có chắc muốn xóa loại phòng này?')" href="{{url('adminKS/loaiphong/findbyKS/'.$d->UIDLoaiPhong.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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