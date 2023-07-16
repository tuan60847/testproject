@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem chi tiết đơn đặt phòng
                <a href="{{url('/adminKS/dondadat/finbydKS')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form @if(Session::has('cksData')) action="{{url('/adminKS/dondadat/findbyKS')}}" @endif method="GET">
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <th>Mã đơn đặt phòng</th>
                            <td>{{$ctddp->MaDDP}}</td>
                        </tr>
                        <tr>
                            <th>Mã loại phòng</th>
                            <td></td>
                        </tr>
                        <th>Số ngày ở</th>
                        <td></td>
                        </tr>
                        <tr>
                            <th>Số lượng phòng</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Tổng tiền</th>
                            <td></td>
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