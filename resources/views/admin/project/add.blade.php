@extends('layouts.admin')
@section('additionalCSS')
    <!-- Select2 -->

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 0;
            height: 35px;
        }
    </style>
@endsection

@section('title')
    Add Project
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
           @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif
        </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.project.addPost') }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('name_of_contact') ? 'has-error' :'' }}">
                            <label for="name_of_contact" class="col-sm-2 control-label">Name of Contract</label>

                            <div class="col-sm-10">
                                <input type="text" id="name_of_contact" class="form-control" placeholder="Enter Name of Contract
"
                                       name="name_of_contact" value="{{ old('name_of_contact') }}">

                                @error('name_of_contact')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('contact_no') ? 'has-error' :'' }}">
                            <label for="contact_no" class="col-sm-2 control-label">Contract No.</label>

                            <div class="col-sm-10">
                                <input type="text" id="contact_no" class="form-control" placeholder="Enter Contact No
"
                                       name="contact_no" value="{{ old('contact_no') }}">

                                @error('contact_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('client') ? 'has-error' :'' }}">
                            <label for="client" class="col-sm-2 control-label">Client</label>

                            <div class="col-sm-10">
                                <input type="text" id="client" class="form-control" placeholder="Enter Client
"
                                       name="client" value="{{ old('client') }}">

                                @error('client')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('project_name') ? 'has-error' :'' }}">
                            <label for="project_name" class="col-sm-2 control-label">Project Name</label>

                            <div class="col-sm-10">
                                <input type="text" id="project_name" class="form-control" placeholder="Enter Project Name
"
                                       name="project_name" value="{{ old('project_name') }}">

                                @error('project_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('work_order_value') ? 'has-error' :'' }}">
                            <label for="work_order_value" class="col-sm-2 control-label">Enter Work Order value</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Work Order value"
                                       name="work_order_value" value="{{ old('work_order_value') }}">

                                @error('work_order_value')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Image</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image">

                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('additionalJS')
@stop
