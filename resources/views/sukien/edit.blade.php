@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa sự kiện
                <a href="{{url('/admin/sukien')}}" class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
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
                <form action="{{url('admin/sukien/'.$data->maSuKien)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Tên sự kiện</th>
                            <td><input type="text" value="{{$data->TenSuKien}}" name="TenSuKien" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td><textarea name="Mota" id="" cols="30" rows="10" class="form-control">{{$data->Mota}}</textarea></td>
                        </tr>
                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td><input type="date" value="{{$data->NgayBatDau}}" name="NgayBatDau" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Ngày kết thúc</th>
                            <td><input type="date" value="{{$data->NgayKetThuc}}" name="NgayKetThuc" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mã địa điểm du lịch</th>
                            <td><input type="text" value="{{$data->MaDDDL}}" name="MaDDDL" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <input type="file" multiple name="image[]">
                                        @foreach($data->hinhanhsukiens as $img)
                                        <td class="imgcol{{$img->src}}">
                                            @if($img)
                                            <img width="150" height="200" src="{{asset($img->src)}}" alt="Image" />
                                            @endif
                                            <p>
                                                <!-- <button type="button" onclick="return confirm('Bạn có chắc muốn xóa hình này?')" class="btn btn-danger btn-sm delete-image" data-image-id="{{$img->maSuKien}}">
                                                    <i class="fa fa-trash"></i> -->
                                                <a class="btn btn-danger btn-sm delete-image" href="{{url('admin/delete').'/'.$img->src}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </button>
                                            </p>
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-success btn-sm" value="Sửa">
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
<link href="
 vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete-image").on('click', function() {
            var _img_id = $(this).attr('data-image-id');
            var _vm = $(this);
            $.ajax({
                url: "{{url('admin/imgsukien/delete')}}/" + _img_id,
                dataType: 'json',
                beforeSend: function() {
                    _vm.addClass('disabled');
                },
                success: function(res) {
                    if (res.bool == true) {
                        $(".imgcol" + _img_id).remove();
                    }
                    _vm.removeClass('disabled');
                }
            });
        });
    });
</script>
@endsection
@endsection