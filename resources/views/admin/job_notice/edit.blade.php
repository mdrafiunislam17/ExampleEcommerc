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
    Edit Job Notice
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
                <h3 class="box-title">Edit Job Notice Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.job.notice.editPost', ['jobNotice' => $jobNotice->id]) }}">
                @csrf

                <div class="box-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                        <label for="title" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" id="title" class="form-control" placeholder="Enter Title"
                                   name="title" value="{{ old('title', $jobNotice->title) }}">
                            @error('title')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="slug" class="col-sm-2 control-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ old('slug', $jobNotice->slug) }}" required>
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="editor" rows="10" name="description">{{ old('description', $jobNotice->description) }}</textarea>
                            @error('description')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ old('status', $jobNotice->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $jobNotice->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Update Job Notice</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

{{-- @section('additionalJS') --}}
{{--    <!-- CK Editor --> --}}
{{--    <script src="{{ asset('themes/back/bower_components/ckeditor/ckeditor.js') }}"></script> --}}
{{--    <script> --}}
{{--        $(function () { --}}
{{--            CKEDITOR.replace('editor'); --}}
{{--        }); --}}
{{--    </script> --}}
{{-- @stop --}}
