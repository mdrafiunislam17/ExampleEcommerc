@extends('layouts.admin')

@section('title')
    Add Slider
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Slider Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                      action="{{ route('admin.slider.addPost') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Image</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image">

                                @error('image')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('heading') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Heading</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter heading"
                                       name="heading" value="{{ old('heading') }}">

                                @error('heading')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('subheading') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Subheading</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter subheading"
                                       name="subheading" value="{{ old('subheading') }}">

                                @error('subheading')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('head_color') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Headline Text color</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="head_color" value="{{ old('head_color') }}">

                                @error('head_color')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sub_head_color') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sub head line text color</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="sub_head_color" value="{{ old('sub_head_color') }}">

                                @error('sub_head_color')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sort</label>

                            <div class="col-sm-10">
                                <input type="number" min="1" class="form-control"
                                       name="sort" value="{{ old('sort') }}">

                                @error('sort')
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

