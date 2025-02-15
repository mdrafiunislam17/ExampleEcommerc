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
    Add Membership & Certificate
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
                    <h3 class="box-title">Membership & Certificate Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.add_certificate_post') }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label for="title" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" id="name_of_contact" class="form-control" placeholder="Enter Title
"
                                       name="title" value="{{ old('title') }}">

                                @error('title')
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
