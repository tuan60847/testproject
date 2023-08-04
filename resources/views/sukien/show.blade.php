@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem chi tiết sự kiện
                <a href="{{url('/admin/sukien')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{url('/admin/sukien'.$data->MaSuKien)}}" method="GET">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên sự kiện</th>
                            <td>{{$data->TenSuKien}}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{$data->Mota}}</td>
                        </tr>
                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td>{{$data->NgayBatDau}}</td>
                        </tr>
                        <tr>
                            <th>Ngày kết thúc</th>
                            <td>{{$data->NgayKetThuc}}</td>
                        </tr>
                        <tr>
                            <th>Mã địa điểm du lịch</th>
                            <td>{{$data->MaDDDL}}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        @foreach($data->hinhanhsukiens as $img)
                                        <td class="imgcol{{asset($img->src)}}">
                                            <img width="150" height="200" src="{{asset($img->src)}}">
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
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
