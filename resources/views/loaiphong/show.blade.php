@extends('layoutKS')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Xem loại phòng
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
                <form action="{{url('/adminKS/loaiphong/findbyKS/'.$loaiphong->UIDLoaiPhong)}}" method="GET" enctype="multipart/form-data">

                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên loại phòng</th>
                            <td>{{$loaiphong->TenLoaiPhong}}</td>
                        </tr>
                        <tr>
                            <th>Máy lạnh</th>
                            <td>{{$loaiphong->isMayLanh}}</td>
                        </tr>
                        <tr>
                            <th>Số giường</th>
                            <td>{{$loaiphong->soGiuong}}</td>
                        </tr>
                        <tr>
                            <th>Giá phòng</th>
                            <td>{{$loaiphong->Gia}}</td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td>{{$loaiphong->soLuongPhong}}</td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        @foreach($loaiphong->hinhanhloaiphongs as $img)
                                        <td class="imgcol{{asset($img->src)}}">
                                            <img width="150" height="200" src="{{asset($img->src)}}" />
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
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete-image").on('click', function() {
            var _img_id = $(this).attr('data-image-id');
            var _vm = $(this);
            $.ajax({
                url: "{{url('adminKS/imgloaiphong/delete')}}/" + _img_id,
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