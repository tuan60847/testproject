@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Thêm hình khách sạn</h6>
    </div>
    <div class="card-body">
      @if(Session::has('success'))
      <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      <div class="table-responsive">
        <form action="{{url('/city')}}" method="GET" enctype="multipart/form-data">
          @csrf
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
              <th>Hình ảnh khách sạn</th>
             <td><input type="file" name="price" class="form-control"></td>
            </tr>
            <tr>
              <td>
                <input type="submit" class="btn btn-success btn-sm" value="Thêm">
              </td>
            </tr>
          </table>
        </form>
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