@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Edit Client testimonial
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Client testimonial Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.admin_edit_client_testimonial_post', ['say' => $say->id]) }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ $say->name }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('designation') ? 'has-error' :'' }}">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>

                            <div class="col-sm-10">
                                <input type="text" id="designation" class="form-control" placeholder="Enter Designation"
                                       name="designation" value="{{ $say->designation }}">

                                @error('designation')
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


                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label for="editor" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <textarea class="form-control"  rows="15" name="description" id="editor" placeholder="Enter Description">{{$say->description}}</textarea>
                                @error('description')
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


