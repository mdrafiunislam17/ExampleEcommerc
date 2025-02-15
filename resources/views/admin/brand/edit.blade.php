@extends('layouts.admin')

@section('title', 'Edit Brand')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <i class="fas fa-edit"></i> Edit Brand Information
                    </h4>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.brand') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                      action="{{ route('admin.brand.editPost', $brand->id) }}">
                    @csrf

                    <div class="box-body">

                        <!-- Brand Name Field -->
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name" class="col-sm-2 control-label">Brand Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $brand->name) }}" required>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Slug Field -->
                        <div class="form-group @error('slug') has-error @enderror">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" id="slug" class="form-control"
                                       value="{{ old('slug', $brand->slug) }}" required>
                                @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo Image Field -->
                        <div class="form-group @error('logo') has-error @enderror">
                            <label for="logo" class="col-sm-2 control-label">Brand Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="logo" class="form-control">
                                @if($brand->logo)
                                    <p><img src="{{ asset('storage/uploads/brand/' . $brand->logo) }}" width="100"></p>
                                @endif
                                @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description"
                                          class="form-control">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="form-group @error('status') has-error @enderror">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" {{ old('status', $brand->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $brand->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Form Footer -->
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
