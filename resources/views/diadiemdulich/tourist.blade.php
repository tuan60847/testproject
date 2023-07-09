@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Địa điểm du lịch</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Địa điểm du lịch</h6>
        <a href="{{url('tourist/create')}}" class="float-right btn-primary btn-sm">Thêm Mới</a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã địa điểm </th>
                        <th>Tên địa điểm </th>
                        <th>Địa chỉ</th>
                        <th>Mô tả</th>
                        <th>Giá vé</th>
                        <th>Mã thành phố</th>
                        <th>Thời gian hoạt động</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                <th>Mã địa điểm </th>
                        <th>Tên địa điểm </th>
                        <th>Địa chỉ</th>
                        <th>Mô tả</th>
                        <th>Giá vé</th>
                        <th>Mã thành phố</th>
                        <th>Thời gian hoạt động</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($data)
                    @foreach($data as $d)
                    <tr>
                        <td>{{$d->MaDDDL}}</td>
                        <td>{{$d->TenDiaDiemDuLich}}</td>
                        <td>{{$d->DiaChi}}</td>
                        <td>{{$d->MoTa}}</td>
                        <td>{{$d->GiaTien}}</td>
                        <td>{{$d->MaTP}}</td>
                        <td>{{$d->ThoiGianHoatDong}}</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>
                            <a href="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
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
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    @endsection
@endsection