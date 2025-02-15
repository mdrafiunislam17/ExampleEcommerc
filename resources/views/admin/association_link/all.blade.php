@extends('layouts.admin')

@section('title')
    Association web link
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
                    <a class="btn btn-primary" href="{{ route('admin.association_web_url_add_post') }}">Add Association web link</a>

                    <hr>

                    <table id="table" class="table table-bordered">
                       <thead>
                       <tr>
                           <th>Sl</th>
                           <th>Name</th>
                           <th>Url</th>
                           <th width="15%">Action</th>
                       </tr>
                       </thead>

                       <tbody>
                       @foreach($links as $item)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>{{ $item->name }}</td>
                               <td><a target="_blank" href="{{ $item->web_url}}">{{ $item->web_url}}</a></td>
                               <td>
                                   <a class="btn btn-primary btn-sm" href="{{ route('admin.association_web_url_edit', ['link' => $item->id]) }}">Edit</a>
                                   <a role="button" class="btn btn-danger btn-sm btnDelete" data-id="{{ $item->id }}">Delete</a>

                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline" id="modalBtnDelete">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
                    method: "POST",
                    url: "{{ route('admin.association_web_url_delete') }}",
                    data: { id: selectedId }
                }).done(function( msg ) {
                    location.reload();
                });
            });
        });
    </script>
@stop
