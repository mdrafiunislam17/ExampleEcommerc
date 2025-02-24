@extends('layouts.admin')

@section('title')
    Edit News/Event
@stop

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit News/Event</h4>
            </div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.news.editPost', ['news' => $news->id]) }}">
                @csrf

                <div class="card-body">

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter News/Event Name" value="{{ old('name', $news->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="imageInput" name="image" class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Show Existing Image -->
                        @if($news->image)
                            <div class="mt-3">
                                <label>Current Image:</label><br>
                                <img src="{{ asset('uploads/news/' . $news->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;" id="currentImage">
                            </div>
                        @endif

                        <!-- New Image Preview -->
                        <div class="mt-3" id="previewContainer" style="display: none;">
                            <label>New Image Preview:</label><br>
                            <img id="imagePreview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="editor" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="8" name="description" id="editor" placeholder="Enter Description">{!! old('description', $news->description) !!}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
@stop

@section('additionalJS')
    <!-- CKEditor -->
    <script src="{{ asset('themes/back/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            // Initialize CKEditor
            CKEDITOR.replace('editor');

            // Image Preview
            $('#imageInput').change(function () {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $('#imagePreview').attr('src', event.target.result);
                        $('#previewContainer').show();
                        $('#currentImage').hide();
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@stop
