@extends('layouts.admin')

@section('title')
    About Us
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="15%">Action</th>
                            @if($about)
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.edit_about', ['about' => $about->id]) }}">Edit</a>
                                </td>
                            @else
                                <td>
                                    <p>No data available</p>
                                </td>
                            @endif

                        </tr>
                        <tr>
                            <th width="15%">Image</th>
                            @if($about && $about->image)
                                <td>
                                    <img style="width: 200px; height: auto; object-fit: contain"
                                         src="{{ asset('uploads/about/thumbs/'.$about->image) }}"
                                         height="300px">
                                </td>
                            @else
                                <td>
                                    <img style="width: 200px; height: auto; object-fit: contain"
                                         src="{{ asset('uploads/about/thumbs/default.jpg') }}"
                                         height="300px">
                                    <p>No image available</p>
                                </td>
                            @endif

                        </tr>
                        @if($about)
                            <tr>
                                <th width="15%">Company Over View</th>
                                <td>{!! $about->text !!}</td>
                            </tr>
                            <tr>
                                <th width="15%">Corporate social responsibility</th>
                                <td>{!! $about->text2 !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th width="15%">Company Over View</th>
                                <td>No data available</td>
                            </tr>
                            <tr>
                                <th width="15%">Corporate social responsibility</th>
                                <td>No data available</td>
                            </tr>
                        @endif




                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('additionalJS')

@stop
