@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem Loại phòng
                @if(Session::has('cksData'))
                <a href="{{url('/adminKS/loaiphong/findbyKS/'.Session::get('cksData')->ADMINKS)}}" class="float-right btn-primary btn-sm">Tất cả</a>
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(Session::has('cksData'))
                <form action="{{url('/adminKS/loaiphong/findbyKS/'.Session::get('cksData')->ADMINKS)}}" method="GET">
                    @endif
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <th>Tên loại phòng</th>
                            <td>{{$loaiphongs->TenLoaiPhong}}</td>
                        </tr>
                        <tr>
                            <th>Máy lạnh</th>
                            <td>{{$loaiphongs->isMayLanh}}</td>
                        </tr>
                        <tr>
                            <th>Số giường</th>
                            <td>{{$loaiphongs->soGiuong}}</td>
                        </tr>
                        <tr>
                            <th>Giá phòng</th>
                            <td>{{$loaiphongs->Gia}}</td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td>{{$loaiphongs->soLuongPhong}}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        @foreach($loaiphongs->hinhanhloaiphongs as $img)
                                        <td class="imgcol{{$img->UIDLoaiPhong}}">
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