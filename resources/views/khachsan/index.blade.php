@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Khách sạn</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Khách sạn
                <a href="{{url('/admin/khachsan/create')}}" class="float-right btn-primary btn-sm">Thêm mới</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                        @if($data )
                        @foreach($data as $d)
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