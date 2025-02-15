@extends('layouts.admin')

@section('title')
    Sub Category Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Sub Category Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('product_sub_category.edit',['subCategory'=>$subCategory->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('business') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Business</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="business" id="business">
                                    <option value="">Select Business</option>

                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ $subCategory->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                    @endforeach
                                </select>

                                @error('business')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('category') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Category</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select Category</option>
                                </select>

                                @error('category')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ $subCategory->name }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sort</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Sort"
                                       name="sort" value="{{ $subCategory->sort }}">

                                @error('sort')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($subCategory->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($subCategory->status == '0' ? 'checked' : '')) :
                                            (old('status') == '0' ? 'checked' : '') }}>
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
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
@endsection

@section('additionalJS')
    <script>
        $(function () {
            var categorySelected = '{{ $subCategory->product_category_id }}';

            $('#business').change(function () {
                var businessId = $(this).val();


                $('#category').html('<option value="">Select Category</option>');

                if (businessId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_product_sub_category') }}",
                        data: { businessId: businessId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (categorySelected == item.id)
                                $('#category').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#category').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#business').trigger('change');
        });
    </script>
@endsection
