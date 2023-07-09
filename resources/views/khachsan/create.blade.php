@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm khách sạn
                <a href="{{url('/admin/khachsan')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session:: has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form action="{{url('/admin/khachsan/')}}" method="GET">
                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên khách sạn</th>
                            <td><input type="text" name="TenTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><input type="text" name="TenTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>SDT</th>
                            <td><input type="text" name="TenTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Buffet</th>
                            <td><input type="text" name="TenTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Wifi</th>
                            <td><input type="text" name="TenTP" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình thành phố</th>
                            <td><input type="file" multiple name="imgs[]"></td>
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