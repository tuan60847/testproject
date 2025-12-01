@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm loại phòng
                <a @if(Session::has('cksData')) href="{{url('/adminKS/loaiphong/findbyKS/'. Session::get('cksData')->ADMINKS)}}" @endif class="float-right btn-primary btn-sm">Tất cả</a>
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

                <form @if(Session::has('cksData')) action="{{url('/adminKS/loaiphong/findbyKS/'.Session::get('cksData')->ADMINKS.'/')}}" @endif method="POST" enctype="multipart/form-data">

                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên loại phòng</th>
                            <td><input type="text" name="TenLoaiPhong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Máy lạnh</th>
                            <td><input type="text" name="isMayLanh" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Số giường</th>
                            <td><input type="text" name="soGiuong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Giá phòng</th>
                            <td><input type="text" name="Gia" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td><input type="text" name="soLuongPhong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình loại phòng</th>
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