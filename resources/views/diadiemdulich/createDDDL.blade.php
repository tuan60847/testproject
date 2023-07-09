@extends('layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm địa điểm</h6>
    </div>
    <div class="card-body">
    @if(Session::has('success'))
     <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
        <div class="table-responsive">
        <form action="{{url('/create')}}" method="GET">
            @csrf
            <table class="table table-bordered" >
                <tr>
                   <th>Tên địa điểm</th>
                   <td><input type="text" name="title" class="form-control"></td> 
                </tr>
              <tr>
              <th>Địa chỉ</th>
              <td><input type="text" name="" class="form-control"></td> 
              </tr>
              <tr>
              <th>Mô tả</th>
              <td><textarea name="detail" id="" cols="30" rows="10" class="form-control"></textarea></td>
              </tr>
              <tr>
                <th>Giá vé</th>
                <td><input type="text" name="title" class="form-control"></td>
              </tr>
              <tr>
                <th>Mã thành phố</th>
                <td><select name="data" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                 @foreach($data as $d)
                  <option value="{{$d->MaTP}}">{{$d->MaTP}}</option>
                 @endforeach
                </select>
              </td> 
              </tr>
              <tr>
                <th>Thời gian hoạt động</th>
                <td><input type="text" name="title" class="form-control"></td> 
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
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    @endsection
@endsection