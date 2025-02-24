@extends('layouts.admin')

@section('title', 'Create Job Application')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="fw-bold">Apply for a Job</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="name">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your full name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="father_name">Father's Name:</label>
                                    <input type="text" name="father_name" id="father_name" class="form-control" required placeholder="Enter your father's name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="mother_name">Mother's Name:</label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control" required placeholder="Enter your mother's name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="date_of_birth">Date of Birth:</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="gender">Gender:</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="martial_status">Marital Status:</label>
                                    <select name="martial_status" id="martial_status" class="form-control" required>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Divorced</option>
                                        <option value="4">Widowed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email address">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="mobile">Mobile:</label>
                                    <input type="tel" name="mobile" id="mobile" class="form-control" required placeholder="Enter your mobile number" pattern="^(01[3-9]\d{8})$" title="Please enter a valid Bangladesh mobile number starting with 01 followed by 9 digits">
                                </div>


                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="national_id">National ID:</label>
                                <input type="text" name="national_id" id="national_id" class="form-control" required placeholder="Enter your National ID">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="religion_status">Religion:</label>
                                <input type="text" name="religion_status" id="religion_status" class="form-control" required placeholder="Enter your religion">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="present_address">Present Address:</label>
                                <textarea name="present_address" id="present_address" class="form-control" required placeholder="Enter your current address"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="permanent_address">Permanent Address:</label>
                                <textarea name="permanent_address" id="permanent_address" class="form-control" required placeholder="Enter your permanent address"></textarea>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="photo">Photo:</label>
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" for="cv">CV (PDF/DOC):</label>
                                    <input type="file" name="cv" id="cv" class="form-control" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
