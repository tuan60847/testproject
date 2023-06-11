@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm Khách sạn</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" >
                <tr>
                   <th>Tên khách sạn</th>
                   <td><input type="text" name="title" class="form-controll"></td> 
                </tr>
                <tr>
                   <th>Title</th>
                   <td><input type="text" name="title" class="form-controll"></td> 
                </tr>
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