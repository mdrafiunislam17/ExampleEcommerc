@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Gallery Image Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('admin.gallery.add')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label class="col-sm-12">Title</label>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Enter Title"
                                       name="title" value="{{ old('title') }}">

                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Upload Image Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info" id="btnUploadImages" type="button">Upload Images</button>
                                <input type="file" class="hidden" multiple id="inputImages">
                            </div>
                        </div>

                        <br>

                        <!-- Drag and Drop Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div style="width: 100%;height: auto;border: 3px dotted {{ $errors->has('imagesId') ? 'red' :'black' }};padding: 20px;"
                                     ondrop="drop(event)" ondragover="allowDrop(event)">
                                    <div class="row" id="images" style="padding: 20px;">
                                        <span>Drag & Drop Images from your computer</span>
                                        <ul id="image-container" class="block__list block__list_tags">
                                            @if (old('imagesId') != null && sizeof(old('imagesId')) > 0)
                                                @foreach(old('imagesId') as $img)
                                                    <li>
                                                        <div class="image-item" style="margin-right: 10px">
                                                            <img class="img-thumbnail img" style="margin-bottom: 10px"
                                                                 src="{{ asset(old('imagesSrc.'.$loop->index)) }}">
                                                            <a class="btnRemoveImage">Remove</a>

                                                            <input class="inputImageId" type="hidden" name="imagesId[]" value="{{ $img }}">
                                                            <input class="inputImageSrc" type="hidden" name="imagesSrc[]" value="{{ old('imagesSrc.'.$loop->index) }}">
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('imagesId')
                        <span class="help-block text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="imageTemplate">
        <li>
            <div class="image-item" style="margin-right: 10px">
                <img class="img-thumbnail img" style="margin-bottom: 10px">
                <a class="btnRemoveImage">Remove</a>

                <input class="inputImageId" type="hidden" name="imagesId[]">
                <input class="inputImageSrc" type="hidden" name="imagesSrc[]">
            </div>
        </li>
    </template>
@endsection

@section('additionalJS')

    <script src="{{ asset('themes/back/plugins/sortable/Sortable.min.js') }}"></script>
    <script>
        $(function () {
            // Sortable.js Initialization
            var el = document.getElementById('image-container');
            Sortable.create(el, {
                group: "words",
                animation: 150,
            });

            // Trigger file input click when Upload Images button is clicked
            document.getElementById('btnUploadImages').addEventListener('click', function() {
                document.getElementById('inputImages').click();  // Trigger file input click
            });

            // Handle file input change event
            document.getElementById('inputImages').addEventListener('change', function(event) {
                let files = event.target.files;
                // Handle the selected files here (display images)
                handleFiles(files);
            });

            // Handle drag over event
            function allowDrop(event) {
                event.preventDefault();
            }

            // Handle drop event to display dragged images
            function drop(event) {
                event.preventDefault();
                var files = event.dataTransfer.files;
                handleFiles(files);
            }

            // Function to handle file upload (both drag and drop and file input)
            function handleFiles(files) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (file.type.startsWith("image/")) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var imageItem = document.createElement("li");
                            imageItem.innerHTML = `
                                <div class="image-item" style="margin-right: 10px">
                                    <img class="img-thumbnail img" style="margin-bottom: 10px" src="${e.target.result}">
                                    <a class="btnRemoveImage">Remove</a>
                                    <input class="inputImageId" type="hidden" name="imagesId[]" value="${file.name}">
                                    <input class="inputImageSrc" type="hidden" name="imagesSrc[]" value="${e.target.result}">
                                </div>
                            `;
                            document.getElementById('image-container').appendChild(imageItem);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Only image files are allowed!");
                    }
                }
            }

            // Remove image functionality
            $('body').on('click', '.btnRemoveImage', function () {
                $(this).closest('li').remove();
            });
        });
    </script>
@endsection
