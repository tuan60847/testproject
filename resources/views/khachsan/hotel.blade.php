@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Khách sạn</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Khách sạn</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>UIDKS</th>
                        <th>Tên Khách sạn</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Buffet</th>
                        <th>Wifi</th>
                        <th>isActive</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>UIDKS</th>
                        <th>Tên Khách sạn</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Buffet</th>
                        <th>Wifi</th>
                        <th>isActive</th>
                        <th>Mã DDDL</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($Khachsans)
                    @foreach($Khachsans as $ks)
                    <tr>
                        <td{{$ks->UIDKS}}</td>
                        <td>{{$ks->TenKS}}</td>
                        <td>{{$ks->DiaChi}}</td>
                        <td>{{$ks->SDT}}</td>
                        <td>{{$ks->Buffet}}</td>
                        <td>{{$ks->Wifi}}</td>
                        <td>{{$ks->isActive}}</td>
                        <td>{{$ks->MaDDDL}}</td>
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