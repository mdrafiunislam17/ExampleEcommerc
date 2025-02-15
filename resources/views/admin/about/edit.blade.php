@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Edit About Us
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">About Us Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('edit_about_post', ['about' => $about->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('text') ? 'has-error' :'' }}">
                            <label for="text" class="col-sm-2 control-label">Company Overview</label>

                            <div class="col-sm-10">
                              <textarea class="form-control"  rows="15" name="text" id="editor" placeholder="Enter Text">{{$about->text}}</textarea>
                                @error('text')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group {{ $errors->has('text2') ? 'has-error' :'' }}">
                            <label for="text" class="col-sm-2 control-label">Corporate social responsibility</label>

                            <div class="col-sm-10">
                                <textarea class="form-control"  rows="15" name="text2" id="editor2" placeholder="Enter Corporate social responsibility">{{$about->text2}}</textarea>
                                @error('text2')
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
                        <a href="{{ route('admin_all_about') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('additionalJS')
    <!-- CK Editor -->
    <script src="{{ asset('themes/back/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('editor');
            CKEDITOR.replace('editor2');
        });
    </script>
@stop

