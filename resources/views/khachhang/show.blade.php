@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem chi tiết khách hàng
                <a href="{{url('/admin/khtiemnang')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{url('/admin/khtiemnang')}}" method="GET">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Họ và Tên</th>
                            <td>{{$data->HoTen}}</td>
                        </tr>
                        <tr>
                            <th>Ngày sinh</th>
                            <td>{{$data->NgaySinh}}</td>
                        </tr>
                        <tr>
                            <th>SDT</th>
                            <td>{{$data->SDT}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$data->Email}}</td>
                        </tr>
                        <tr>
                            <th>CMNND/CCCD</th>
                            <td>{{$data->cmnd}}</td>
                        </tr>
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