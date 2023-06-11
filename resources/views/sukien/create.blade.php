@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sự kiện</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" >
                <tr>
                   <th>Tên sự kiện</th>
                   <td><input type="text" name="title" class="form-control"></td> 
                </tr>
              <tr>
              <th>Ngày bắt đầu</th>
              <td><input type="date" class="form-control"></td>
              </tr>
              <tr>
              <th>Ngày kết thúc</th>
                <td><input type="date" class="form-control"></td>
              </tr>
              <tr>
                <th>Địa điểm du lịch</th>
                <td><input type="text" name="title" class="form-control"></td>
              </tr>
              <tr>
                <th>Mô tả</th>
                <td><textarea name="detail" id="" cols="30" rows="10" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td>
                    <input type="submit" class="btn btn-success btn-sm" value="Thêm">
                </td>
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