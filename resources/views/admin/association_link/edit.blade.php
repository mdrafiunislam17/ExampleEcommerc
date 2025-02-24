@extends('layouts.admin')

@section('title', 'Edit Association Web Link')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Association Web Link</h3>
                    <a href="{{ route('admin.association_web_url') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <!-- Form Start -->
                <form class="form-horizontal" method="POST" action="{{ route('admin.association_web_url_edit_post', ['link' => $link->id]) }}">
                    @csrf


                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name', $link->name) }}" required>
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('web_url') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Web URL*</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" name="web_url" value="{{ old('web_url', $link->web_url) }}" required>
                                @error('web_url')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update
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
