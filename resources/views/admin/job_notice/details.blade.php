@extends('layouts.admin')

@section('title')
     Apply Details
@stop
@section('additionalCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
       .vertical-align {
            margin-top: 62px;
        }
       .box {
           padding: 0 15px;
       }
    </style>
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

                   <div class="row">
                       <div class="col-md-8">
                           <h2 class="text-center">Details Information</h2>
                           <table class="table table-bordered">
                               <tr>
                                   <th>Name</th>
                                   <td>{{$job->name}}</td>
                               </tr>
                               <tr>
                                   <th>CV</th>
                                   <td><a target="_blank" href="{{asset('uploads/apply_job/'.$job->cv)}}"><i class="fa fa-file-pdf-o"></i></a></td>
                               </tr>
                               <tr>
                                   <th>Father's Name</th>
                                   <td>{{$job->father_name}}</td>
                               </tr>
                               <tr>
                                   <th>Father's Name</th>
                                   <td>{{$job->father_name}}</td>
                               </tr>
                               <tr>
                                   <th>Mother's Name</th>
                                   <td>{{$job->mother_name}}</td>
                               </tr>
                               <tr>
                                   <th>Date of Birth</th>
                                   <td>{{$job->date_of_birth}}</td>
                               </tr>
                               <tr>
                                   <th>Gender</th>
                                   <td>

                                       @if($job->gender==1)
                                           Male
                                       @else
                                           Female
                                       @endif</td>
                               </tr>
                               <tr>
                                   <th>Email</th>
                                   <td>{{$job->email}}</td>
                               </tr>
                               <tr>
                                   <th>Mobile</th>
                                   <td>{{$job->mobile}}</td>
                               </tr>
                               <tr>
                                   <th>Marital Status</th>
                                   <td>
                                       @if($job->martial_status==1)
                                           Single
                                       @else
                                           Married
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <th>National NID</th>
                                   <td>{{$job->national_id}}</td>
                               </tr>
                               <tr>
                                   <th>Religion</th>
                                   <td>
                                       @if($job->religion_status==1)
                                           Muslim
                                       @elseif($job->religion_status==2)
                                           Hindu
                                       @elseif($job->religion_status==3)
                                           Christan
                                       @elseif($job->religion_status==4)
                                           Buddhist
                                       @else
                                           Other
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <th>Present Address</th>
                                   <td>{{$job->present_address}}</td>
                               </tr>
                               <tr>
                                   <th>Permanent Address</th>
                                   <td>{{$job->permanent_address}}</td>
                               </tr>
                           </table>
                       </div>
                       <div class="col-md-4 text-center vertical-align">

                           <img width="100%" src="{{asset('uploads/apply_job/thumbs/'.$job->photo)}}">
                       </div>
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
                    url: "{{ route('admin.job.apply.delete') }}",
                    data: { id: selectedId }
                }).done(function( msg ) {
                    location.reload();
                });
            });
        });
    </script>
@stop

