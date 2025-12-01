@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin tài khoản</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <div class="table-responsive">
                <form @if(Session::has('cksData')) action="{{url('adminKS/profile/findbyKS/'.Session::get('cksData')->ADMINKS)}}" @endif method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Họ và Tên</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày sinh</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>SDT</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Mật khẩu cũ</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Mật khẩu mới</th>
                            <td>
                                @if(isset($data) && !empty($data->HoTen))
                                <input type="text" value="{{ $data->HoTen }}" name="HoTen" class="form-control">
                                @else
                                <input type="text" value="" name="HoTen" class="form-control">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-success btn-sm" value="Sửa">
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