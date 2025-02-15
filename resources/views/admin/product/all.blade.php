@extends('layouts.admin')

@section('additionalCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Product
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
                <div class="box-body">
                    <a class="btn btn-primary" href="{{ route('admin.product.add') }}">Add Product</a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>category</th>
                            <th>brand</th>
                            <th>price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                <td>{{ $product->brand ? $product->brand->name : 'N/A' }}</td>
                                <td>{{$product->price}}</td>

                                <td>
                                    @if ($product->status == 'active')
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.product.edit', ['product' => $product->id]) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btnDelete" data-id="{{ $product->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Deletion Confirmation -->
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
    </div>
    <!-- /.modal -->
@endsection

@section('additionalJS')
    <!-- DataTables -->
    <script src="{{ asset('themes/back/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>



    <script>
        $(function () {
            $('#table').DataTable();
        })

        $(function () {
            var selectedId;

            // Show delete confirmation modal and set the selected brand ID
            $('.btnDelete').click(function () {
                $('#modal-delete').modal('show');
                selectedId = $(this).data('id');
            });

            // Handle deletion when clicking the delete button in the modal
            $('#modalBtnDelete').click(function () {
                $.ajax({
                    type: "DELETE", // DELETE method used for deletion
                    url: "{{ route('admin.product.delete') }}", // Route for deleting brand
                    data: {
                        id: selectedId,
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        // Reload the page after successful deletion
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
@endsection
