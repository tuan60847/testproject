@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thành phố</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thành phố</h6>
            <a href="{{url('/create')}}" class="float-right btn-primary btn-sm">Thêm Mới</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Khách sạn</th>
                            <th>Hình ảnh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã Khách sạn</th>
                            <th>Hình ảnh</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($hinhanhk)
                        @foreach($hinhanhk as $d)
                        <tr>
                            <td>{{$d->UIDKS}}</td>
                            <td>{{$d->src}}</td>
                            <td>
                                <a href="{{url('/imgKS/'.$d->UIDKS)}}" method="GET" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{url('imgKS/'.$d->UIDKS.'/edit')}}" method="POST" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="confirm('Bạn có muốn xóa thành phố này không?')" href="{{url('city/'.$d->MaTP.'/delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection
@endsection