@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật đơn đặt phòng</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <div class="table-responsive">
                <form action="{{url('adminKS/dondatphong/'.$dondatphong->UIDDatPhong)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Mã đặt phòng</th>
                            <td>{{Str::limit($dondatphong->UIDDatPhong)}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$dondatphong->EmailKH}}</td>
                        </tr>
                        <tr>
                            <th>Ngày đặt phòng</th>
                            <td>{{$dondatphong->NgayDatPhong}}</td>
                        </tr>

                        <tr>
                            <th>Tiền cọc</th>
                            <td>{{$dondatphong->TienCoc}}</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền</th>
                            <td>{{number_format($dondatphong->tongtien, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                <select name="isChecked" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    @if($dondatphong->isChecked==1)
                                    <option value="1" selected>Xác nhận của khách hàng</option>
                                    <option value="2">Xác nhận của khách sạn</option>
                                    <option value="6">Hủy đơn đặt phòng</option>
                                    @elseif ($dondatphong->isChecked == 2)
                                    <option value="2" selected>Xác nhận của khách sạn</option>
                                    <option value="3">Check In</option>
                                    @elseif ($dondatphong->isChecked == 0)
                                    <option value="0">Chưa xác nhận</option>
                                    <option value="1">Xác Nhận</option>
                                    <option value="6">Hủy đơn đặt phòng</option>
                                    @elseif ($dondatphong->isChecked == 3)
                                    <option value="3" selected>Check In</option>
                                    <option value="5">Check out</option>
                                    @elseif ($dondatphong->isChecked == 5)
                                    <option value="5" selected>Check out</option>
                                    @elseif ($dondatphong->isChecked == 6)
                                    <option value="6" selected>Hủy đơn đặt phòng</option>
                                    @endif
                                </select>


                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" class="btn btn-success btn-sm" value="Cập nhật">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Custom styles for this page -->
<link href="
 vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

@endsection