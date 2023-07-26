@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa loại phòng
                <a @if(Session::has('cksData')) href="{{url('/adminKS/loaiphong/findbyKS/'. Session::get('cksData')->ADMINKS)}}" @endif class="float-right btn-primary btn-sm">Tất cả</a>
            </h6>
        </div>
        <div class="card-body">
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif
            @if(Session:: has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form action="{{url('/adminKS/loaiphong/findbyKS/'.$loaiphong->UIDLoaiPhong)}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên loại phòng</th>
                            <td><input type="text" value="{{$loaiphong->TenLoaiPhong}}" name="TenLoaiPhong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Máy lạnh</th>
                            <td><input type="text" value="{{$loaiphong->isMayLanh}}" name="isMayLanh" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Số giường</th>
                            <td><input type="text" value="{{$loaiphong->soGiuong}}" name="soGiuong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Giá phòng</th>
                            <td><input type="text" value="{{$loaiphong->Gia}}" name="Gia" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td><input type="text" value="{{$loaiphong->soLuongPhong}}" name="soLuongPhong" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <input type="file" multiple name="image[]">
                                        @foreach($loaiphong->hinhanhloaiphongs as $img)
                                        <td class="imgcol{{$img->src}}">
                                            @if($img)
                                            <img width="150" height="200" src="{{asset($img->src)}}" />
                                            @endif
                                            <p>
                                                <!-- <button type="button" onclick="return confirm('Bạn có chắc muốn xóa hình này?')" class="btn btn-danger btn-sm delete-image" data-image-id="{{$img->src}}">
                                                    <i class="fa fa-trash"></i>
                                                </button> -->
                                                <a class="btn btn-danger btn-sm delete-image" href="{{url('adminKS/delete').'/'.$img->src}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </p>
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
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
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $(".delete-image").on('click', function() {
            var _img_id = $(this).attr('data-image-id');
            var _vm = $(this);
            var_dump(_vm);
            $.ajax({
                url: "{{url('adminKS/imgloaiphong/delete/')}}" + _img_id,
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
</script> -->
<script type="text/javascript">
    function confirmAndDeleteImage(buttonElement) {
        if (confirm('Bạn có chắc muốn xóa hình này?')) {
            var _img_id = $(buttonElement).attr('data-image-id');
            var _vm = $(buttonElement);

            $.ajax({
                url: `{{ url('adminKS/imgloaiphong/delete/') }}/${_img_id}`,
                type: 'GET', // Sử dụng phương thức GET
                dataType: 'json',
                beforeSend: function() {
                    _vm.addClass('disabled');
                },
                success: function(res) {
                    if (res.bool === true) {
                        $(".imgcol[src='" + _img_id + "']").remove();
                    } else {
                        alert("Lỗi xóa hình ảnh");
                    }
                    _vm.removeClass('disabled');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Có lỗi xảy ra khi gửi yêu cầu xóa hình ảnh.");
                    _vm.removeClass('disabled');
                }
            });
        }
    }
</script>
@endsection
@endsection