@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem khách sạn
                <a href="{{url('/admin/khachsan')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{url('/admin/khachsan')}}" method="GET">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên khách sạn</th>
                            <td>{{$data->TenKS}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{$data->DiaChi}}</td>
                        </tr>
                        <tr>
                            <th>SDT</th>
                            <td>{{$data->SDT}}</td>
                        </tr>
                        <tr>
                            <th>Buffet</th>
                            <td>{{$data->Buffet}}</td>
                        </tr>
                        <tr>
                            <th>Wifi</th>
                            <td>{{$data->Wifi}}</td>
                        </tr>
                        <tr>
                            <th>MaDDDL</th>
                            <td>{{$data->MaDDDL}}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        @foreach($data->hinhanhks as $img)
                                        <td class="imgcol{{asset($img->src)}}">
                                            <img width="150" height="200" src="{{asset($img->src)}}">
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </td>
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