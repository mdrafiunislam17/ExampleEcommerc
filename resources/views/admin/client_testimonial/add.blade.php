@extends('layouts.admin')
@section('title')
    Add Client Testimonial
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="panel-title">Client Testimonial Information</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('admin.admin_all_client_testimonial') }}" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                          action="{{ route('admin.admin_add_client_testimonial_post') }}">
                        @csrf

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('designation') ? 'has-error' :'' }}">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-10">
                                <input type="text" id="designation" class="form-control" placeholder="Enter Designation"
                                       name="designation" value="{{ old('designation') }}">
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
                                <textarea class="form-control" rows="10" name="description" id="editor" placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Save</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
