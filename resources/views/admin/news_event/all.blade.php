@extends('layouts.admin')

@section('title')
    All New/ Event
@stop
@section('additionalCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <a class="btn btn-primary" href="{{ route('admin.news.add') }}">Add News/ Event</a>

                    <hr>

                    <table id="table" class="table table-bordered">
                       <thead>
                       <tr>
                           <th>Sl</th>
                           <th>Image</th>
                           <th>Name</th>
                           <th>Date</th>
                           <th width="15%">Action</th>
                       </tr>
                       </thead>

                       <tbody>
                       @foreach($news as $item)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>
                                   <img src="{{ asset('storage/uploads/news/'.$item->image) }}" height="50px">


                               </td>
                               <td>{{ $item->name }}</td>
                               <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                               <td>
                                   <a class="btn btn-primary btn-sm" href="{{ route('admin.news.edit', ['news' => $item->id]) }}">
                                       <i class="fas fa-edit"></i></a>
                                   <a role="button" class="btn btn-danger btn-sm btnDelete" data-id="{{ $item->id }}">
                                       <i class="fas fa-trash-alt"></i>
                                   </a>

                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <p class="lead">Are you sure you want to delete this item?</p>
                    <small class="text-muted">This action cannot be undone.</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="modalBtnDelete">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    <!-- /.modal -->
@stop

@section('additionalJS')
    <!-- DataTables -->
    <script src="{{ asset('themes/back/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            $('#table').DataTable();
        })
    </script>
    <script>


            $(function () {
                var selectedId;

                $('.btnDelete').click(function () {
                    $('#modal-delete').modal('show');
                    selectedId = $(this).data('id');
                });

                $('#modalBtnDelete').click(function () {
                    $.ajax({
                        type: "DELETE", // DELETE method ব্যবহার করো
                        url: "{{ route('admin.news.delete') }}",
                        data: {
                            id: selectedId,
                            _token: '{{ csrf_token() }}' // CSRF টোকেন পাঠানো হচ্ছে
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert("Error: " + xhr.responseText);
                        }
                    });
                });
            });


    </script>
@stop
