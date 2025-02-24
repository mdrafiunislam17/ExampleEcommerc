@extends('layouts.admin')

@section('title', 'Add Association Web Link')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Association Web Link</h3>
                    <a href="{{ route('admin.association_web_url') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <!-- Form Start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                      action="{{ route('admin.association_web_url_add') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter name..."
                                       name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('web_url') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Web URL*</label>
                            <div class="col-sm-10">
                                <input type="url" id="web_url" name="web_url"
                                       class="form-control"
                                       placeholder="Enter Web URL" value="{{ old('web_url') }}" required>
                                @error('web_url')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@stop
