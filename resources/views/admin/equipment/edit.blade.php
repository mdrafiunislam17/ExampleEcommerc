@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Edit Equipment & Tools
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Equipment Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.admin_edit_equipment_post', ['equipment' => $equipment->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 control-label">Name/Type</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name/Type
"
                                       name="name" value="{{ $equipment->name }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('capacity') ? 'has-error' :'' }}">
                            <label for="capacity" class="col-sm-2 control-label">Capacity</label>

                            <div class="col-sm-10">
                                <input type="text" id="capacity" class="form-control" placeholder="Enter Capacity
"
                                       name="capacity" value="{{$equipment->capacity }}">

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
                                       name="quantity" value="{{ $equipment->quantity }}">

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
                                       name="remark" value="{{ $equipment->remark }}">

                                @error('remark')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        </div>

                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.admin_all_equipment') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('additionalJS')

@stop

