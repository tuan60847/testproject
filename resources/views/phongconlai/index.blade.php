@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thành phố</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thành phố
                <!-- <a href="{{url('/adminKS/phongconlai/create')}}" class="float-right btn-primary btn-sm">Thêm mới</a> -->
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
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Mã loại phòng</th>
                            <th>Số lượng</th>
                            <th>Ngày</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($data )
                        @foreach($data as $d)
                        <tr>
                            <td>{{$d->MaTP}}</td>
                            <td>{{$d->TenTP}}</td>
                            <td>{{Str::limit($d->mota,30)}}</td>
                            <td>{{count($d->hinhanhtps)}}</td>
                            <td>
                                <a href="{{url('admin/thanhpho/'.$d->MaTP)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <!-- <a href="{{url('admin/thanhpho/'.$d->MaTP.'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có chắc muốn xóa thành phố này?')" href="{{url('admin/thanhpho/'.$d->MaTP.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                            </td>
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