@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem địa điểm du lịch
                <a href="{{url('/admin/diadiemdulich')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{url('/admin/diadiemdulich')}}" method="GET">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên địa điểm du lịch</th>
                            <td>{{$data->TenDiaDiemDuLich}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{$data->DiaChi}}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{$data->MoTa}}</td>
                        </tr>
                        <tr>
                            <th>Thời gian hoạt động</th>
                            <td>{{$data->ThoiGianHoatDong}}</td>
                        </tr>
                        <tr>
                            <th>Giá vé</th>
                            <td>{{$data->GiaTien}}</td>
                        </tr>
                        <tr>
                            <th>Mã thành phố</th>
                            <td>{{$data->MaTP}}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        @foreach($data->hinhanhdddls as $img)
                                        <td class="imgcol{{$img->MaDDDL}}">
                                            <img width="150" height="200" src="{{asset('storage/app'.$img->src)}}">
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