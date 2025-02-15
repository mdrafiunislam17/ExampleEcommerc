@extends('layouts.admin')
@section('additionalCSS')

@endsection
@section('title')
    Edit Team Image
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Team Image</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.team.editPost', ['team' => $team->id]) }}">
                    @csrf

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label for="title" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" id="title" class="form-control" placeholder="Enter Title"
                                       name="name" value="{{ $team->title }}">

                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label for="client" class="col-sm-2 control-label">Sort</label>

                            <div class="col-sm-2">
                                <input type="number" id="sort" class="form-control" placeholder="Sort
"
                                       name="sort" value="{{ $team->sort }}">

                                @error('sort')
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

