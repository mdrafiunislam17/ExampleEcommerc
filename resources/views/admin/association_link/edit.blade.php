@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Association web link Edit
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Association web link Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.association_web_url_edit', ['link' => $link->id]) }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ $link->name }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('web_url') ? 'has-error' :'' }}">
                            <label for="web_url" class="col-sm-2 control-label">Web Url</label>

                            <div class="col-sm-10">
                                <input type="text" id="web_url" class="form-control" placeholder="Enter Web url"
                                       name="web_url" value="{{ $link->web_url }}">

                                @error('web_url')
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


