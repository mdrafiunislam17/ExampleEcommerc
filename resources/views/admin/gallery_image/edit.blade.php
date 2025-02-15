@extends('layouts.admin')

@section('additionalCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/back/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('title')
    Gallery Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Gallery Image Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('admin.gallery-image.editPost', ['gallery' => $gallery->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                            <label class="col-sm-12">Title</label>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Enter Title"
                                       name="title" value="{{ empty(old('title')) ? ($errors->has('title') ? '' : $gallery->title) : old('title') }}">

                                @error('title')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info" id="btnUploadImages">Upload Images</button>
                                <input type="file" class="hidden" multiple id="inputImages">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="width: 100%;height: auto;border: 3px dotted {{ $errors->has('imagesId') ? 'red' :'black' }};padding: 20px;">
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
                                            @else
                                                @if (sizeof($gallery->images) > 0)
                                                    @foreach($gallery->images as $img)
                                                        <li class="img-item">
                                                            <div class="image-item">
                                                                <img class="img-thumbnail img" style="margin-bottom: 10px"
                                                                     src="{{ asset($img->path) }}">
                                                                <a class="btnRemoveImage">Remove</a>

                                                                <input class="inputImageId" type="hidden" name="imagesId[]" value="{{ $img->id }}">
                                                                <input class="inputImageSrc" type="hidden" name="imagesSrc[]" value="{{ $img->path }}">
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
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
    <!-- Select2 -->
    <script src="{{ asset('themes/back/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Sortable -->
    <script src="{{ asset('themes/back/plugins/sortable/Sortable.min.js') }}"></script>
    <script>
        $(function () {


            //Initialize Select2 Elements
            $('.select2').select2();

            // Images
            var el = document.getElementById('image-container');
            Sortable.create(el, {
                group: "words",
                animation: 150,
            });

            $('#btnUploadImages').click(function (e) {
                e.preventDefault();

                $('#inputImages').click();
            });


            $('#images').on({
                'dragover dragenter': function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                },
                'drop': function(e) {
                    var dataTransfer =  e.originalEvent.dataTransfer;
                    if( dataTransfer && dataTransfer.files.length) {
                        e.preventDefault();
                        e.stopPropagation();
                        $.each( dataTransfer.files, function(i, file) {
                            if (file.size > 10000000) {
                                alert('Max allowed image size is 10MB per image.')
                            } else if (file.type != 'image/jpeg' && file.type != 'image/png') {
                                alert('Only jpg and png file allowed.');
                            } else if ($(".image-container").length > 30) {
                                alert('Maximum 30 photos allows');
                            } else {
                                var xmlHttpRequest = new XMLHttpRequest();
                                xmlHttpRequest.open("POST", '{{ route('admin.gallery_upload_image') }}', true);
                                var formData = new FormData();
                                formData.append("file", file);
                                xmlHttpRequest.send(formData);

                                xmlHttpRequest.onreadystatechange = function() {
                                    if (xmlHttpRequest.readyState == XMLHttpRequest.DONE) {
                                        var response = JSON.parse(xmlHttpRequest.responseText);

                                        if (response.success) {
                                            var html = $('#imageTemplate').html();
                                            var item = $(html);
                                            item.find('.img').attr('src', response.data.fullPath);
                                            item.find('.inputImageId').val(response.data.id);
                                            item.find('.inputImageSrc').val(response.data.path);

                                            $('#image-container').append(item);
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            });

            $('#inputImages').change(function (e) {
                $.each(e.target.files, function (index, file) {
                    if (file.size > 10000000) {
                        alert('Max allowed image size is 10MB per image.')
                    } else if (file.type != 'image/jpeg' && file.type != 'image/png') {
                        alert('Only jpg and png file allowed.');
                    } else if ($(".image-container").length > 2) {
                        alert('Maximum 30 photos allows');
                    } else {
                        var xmlHttpRequest = new XMLHttpRequest();
                        xmlHttpRequest.open("POST", '{{ route('admin.gallery_upload_image') }}', true);
                        var formData = new FormData();
                        formData.append("file", file);
                        xmlHttpRequest.send(formData);

                        xmlHttpRequest.onreadystatechange = function() {
                            if (xmlHttpRequest.readyState == XMLHttpRequest.DONE) {
                                var response = JSON.parse(xmlHttpRequest.responseText);

                                if (response.success) {
                                    var html = $('#imageTemplate').html();
                                    var item = $(html);
                                    item.find('.img').attr('src', response.data.fullPath);
                                    item.find('.inputImageId').val(response.data.id);
                                    item.find('.inputImageSrc').val(response.data.path);

                                    $('#image-container').append(item);
                                }
                            }
                        }
                    }
                });

                $(this).val('');
            });

            $('body').on('click', '.btnRemoveImage', function () {
                $(this).closest('li').remove();
            });
        });
    </script>
@endsection
