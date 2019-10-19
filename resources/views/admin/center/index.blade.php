@extends('admin.wrapper')
@section('CSS')
    <link href="{{ asset('js/admin/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
@endsection
@section('content')
      <div class="container-fluid" id="xnxx">
          {{-- {{ var_dump($users) }} --}}
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        @if(session()->get('flash_success'))
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            @if(is_array(json_decode(session()->get('flash_success'), true)))
                {{ implode('', session()->get('flash_success')->all(':message<br/>')) }}
            @else
                {{ session()->get('flash_success') }}
            @endif
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Ngày đăng ký</th>
                    <th>Tùy chọn</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Ngày đăng ký</th>
                    <th>Tùy chọn</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($centers as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="mr-auto mr-auto d-block text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="/user-profile/{{$item->id}}" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-eye" data-toggle="tooltip" data-placement="top"
                                            title="Xem"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger" onclick="deleteProfile({{$item->id}})">
                                        <i class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                                            title="Xóa"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('endJS')      <!-- Page level plugins -->
        <script src="{{asset('js/admin/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/admin/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
        <script src="{{asset('js/admin/plugins.js')}}"></script>
        <!-- Page level custom scripts -->
        <script>
            // Call the dataTables jQuery plugin
            $(document).ready(function() {
            $('#dataTable').DataTable();
            });


            function deleteProfile(id){
                Swal.fire({
                    title: 'Bạn muốn xóa người dùng id ' + id,
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy bỏ',
                    showLoaderOnConfirm: true,
                    preConfirm: (hihi) => {
                        const url = '/admin/centers/'+id+'/delete'

                        return fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            Swal.fire({
                                title: 'xóa thành công'
                            })
                            location.reload(true)
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    })
            }
        </script>
@endsection
