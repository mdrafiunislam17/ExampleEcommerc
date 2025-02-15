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
    Add Equipment & Tools
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
                    <h3 class="box-title">Equipment & Tools Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.admin_add_equipment_post') }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name_of_contact" class="col-sm-2 control-label">Name/Type</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name/Type
"
                                       name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('capacity') ? 'has-error' :'' }}">
                            <label for="capacity" class="col-sm-2 control-label">Capacity.</label>

                            <div class="col-sm-10">
                                <input type="text" id="capacity" class="form-control" placeholder="Enter Capacity
"
                                       name="capacity" value="{{ old('capacity') }}">

                                @error('capacity')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' :'' }}">
                            <label for="quantity" class="col-sm-2 control-label">Quantity</label>

                            <div class="col-sm-10">
                                <input type="text" id="quantity" class="form-control" placeholder="Enter Quantity
"
                                       name="quantity" value="{{ old('quantity') }}">

                                @error('quantity')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('remark') ? 'has-error' :'' }}">
                            <label for="remark" class="col-sm-2 control-label">Remark</label>

                            <div class="col-sm-10">
                                <input type="text" id="remark" class="form-control" placeholder="Enter Remark
"
                                       name="remark" value="{{ old('remark') }}">

                                @error('remark')
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
