@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Phòng còn lại</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Phòng còn lại
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã loại phòng</th>
                            <th>Số lượng</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã loại phòng</th>
                            <th>Số lượng</th>
                            <th>Ngày</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($phongconlai )
                        @foreach($phongconlai as $d)
                        <tr>
                            <td>{{$d->UIDLoaiPhong}}</td>
                            <td>{{$d->SoLuong}}</td>
                            <td>{{$d->Ngay}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
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