@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Sự kiện</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sự kiện</h6>
        <a href="{{url('/createSK')}}" class="float-right btn-primary btn-sm">Thêm Mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã sự kiện</th>
                        <th>Tên sự kiện</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Mã DDDL</th>
                        <th>Mô tả</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                        <th>Mã sự kiện</th>
                        <th>Tên sự kiện</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Mã DDDL</th>
                        <th>Mô tả</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>2011/04/25</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>
                            <a href="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                        </td>
                    </tr>
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