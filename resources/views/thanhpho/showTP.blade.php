@extends('./layout')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm thành phố</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
          <form action="{{url('/city/')}}" method="GET">
            @csrf
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tr>
                <th>Tên thành phố</th>
                <td>{{$data->TenTP}}</td>
              </tr>
              <tr>
                <th>Mô tả</th>
                <td>{{$data->mota}}</td>
              </tr>
              <tr>
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
 <link href="{{ asset('../public/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Page level plugins -->
    <script src="{{ asset('../public/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('../public/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('../public/js/demo/datatables-demo.js') }}"></script>
    @endsection
@endsection