@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm sự kiện
                <a href="{{url('/admin/sukien')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif
            @if(Session:: has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form action="{{url('admin/sukien/')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Tên sự kiện</th>
                            <td><input type="text" name="TenSuKien" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td><textarea name="Mota" id="" cols="30" rows="10" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td><input type="date" name="NgayBatDau" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Ngày kết thúc</th>
                            <td><input type="date" name="NgayKetThuc" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mã địa điểm du lịch</th>
                            <td><input type="text" name="MaDDDL" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình sự kiện</th>
                            <td><input type="file" multiple name="image[]"></td>
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
<link href="
 vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection
@endsection