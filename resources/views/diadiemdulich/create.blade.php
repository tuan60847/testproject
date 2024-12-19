@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm địa điểm du lịch
                <a href="{{url('/admin/diadiemdulich')}}" class="float-right btn-primary btn-sm">Tất cả</a>
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
                <form action="{{url('/admin/diadiemdulich/')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên địa điểm du lịch</th>
                            <td><input type="text" name="TenDiaDiemDuLich" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><input type="text" name="DiaChi" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td><textarea name="MoTa" id="" cols="30" rows="10" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <th>Thời gian hoạt động</th>
                            <td><input type="text" name="ThoiGianHoatDong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Giá vé</th>
                            <td><input type="text" name="GiaTien" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mã thành phố</th>
                            <td><input type="text" name="MaTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình thành phố</th>
                            <td><input type="file" multiple name="image[]"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
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
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
@endsection