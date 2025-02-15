@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <i class="fas fa-edit"></i> Edit Slider
                    </h4>
                    <div class="pull-right">
                        <a href="{{ route('admin.admin_all_slider') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.editPost', ['slider' => $slider->id]) }}">
                    @csrf

                    <div class="box-body">
                        <!-- Image Upload with Preview -->
                        <div class="form-group">
                            <label for="imageInput" class="form-label">Slider Image</label>
                            <div class="position-relative">
                                <img id="previewImage" src="{{ asset('storage/uploads/slider/'.$slider->image) }}" alt="Slider Image" class="img-thumbnail rounded shadow" style="max-height: 100px; max-width: 150px;">
                                <button type="button" id="removeImage" class="btn btn-danger btn-sm position-absolute top-0 end-0" title="Remove Image" onclick="removePreview()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="file" class="form-control mt-2" name="image" id="imageInput" accept="image/*">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Heading -->
                        <div class="form-group">
                            <label for="heading" class="form-label"><i class="fas fa-heading"></i> Heading</label>
                            <input type="text" class="form-control" name="heading" placeholder="Enter heading" value="{{ old('heading', $slider->heading) }}">
                            @error('heading')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subheading -->
                        <div class="form-group mb-3">
                            <label for="subheading" class="form-label"><i class="fas fa-subscript"></i> Subheading</label>
                            <input type="text" class="form-control" name="subheading" placeholder="Enter subheading" value="{{ old('subheading', $slider->subheading) }}">
                            @error('subheading')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Headline Color Picker -->
                        <div class="form-group mb-3">
                            <label for="headColorPicker" class="form-label"><i class="fas fa-paint-brush"></i> Headline Color</label>
                            <input type="color" class="form-control form-control-color" name="head_color" id="headColorPicker" value="{{ old('head_color', $slider->head_color) }}">
                            @error('head_color')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subheadline Color Picker -->
                        <div class="form-group mb-3">
                            <label for="subHeadColorPicker" class="form-label"><i class="fas fa-palette"></i> Sub Headline Color</label>
                            <input type="color" class="form-control form-control-color" name="sub_head_color" id="subHeadColorPicker" value="{{ old('sub_head_color', $slider->sub_head_color) }}">
                            @error('sub_head_color')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="form-group mb-3">
                            <label for="sort" class="form-label"><i class="fas fa-sort-numeric-up-alt"></i> Sort Order</label>
                            <input type="number" class="form-control" min="1" name="sort" value="{{ old('sort', $slider->sort) }}">
                            @error('sort')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit & Cancel Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.admin_all_slider') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- JavaScript for Image Preview & Removal -->
    <script>
        // Update image preview when a new image is selected
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById("previewImage").src = URL.createObjectURL(file);
            }
        });

        // Remove image and reset input when the remove button is clicked
        function removePreview() {
            document.getElementById("previewImage").src = "{{ asset('storage/uploads/slider/'.$slider->image) }}";
            document.getElementById("imageInput").value = "";
        }

        // Live color change preview for heading
        document.getElementById("headColorPicker").addEventListener("input", function() {
            document.getElementById("headingPreview").style.color = this.value;
        });

        // Live color change preview for subheading
        document.getElementById("subHeadColorPicker").addEventListener("input", function() {
            document.getElementById("subHeadingPreview").style.color = this.value;
        });
    </script>
@stop
