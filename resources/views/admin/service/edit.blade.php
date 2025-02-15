@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Edit Business Area
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Business Area Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.service.editPost', ['service' => $service->id]) }}">
                    @csrf

                    <div class="box-body">


                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name_of_contact" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" id="name" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ $service->name}}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="client" class="col-sm-2 control-label">Sort</label>

                            <div class="col-sm-2">
                                <input type="number" id="sort" class="form-control" placeholder="Sort
"
                                       name="sort" value="{{ $service->sort }}">

                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('show_home') ? 'has-error' :'' }}">
                            <label for="show_home" class="col-sm-2 control-label">Show in Product</label>

                            <div class="col-sm-10">
                                <input value="1"  {{ $service->show_home== '1' ? 'checked' : '' }} id="show_home" type="checkbox" name="show_home">
                                @error('show_home')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label for="description" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <textarea id="description" class="form-control" rows="5"  name="description">{{$service->description}}</textarea>
                                @error('description')
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

