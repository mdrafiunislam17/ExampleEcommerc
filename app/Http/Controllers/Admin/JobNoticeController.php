<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobNotice; // Updated to "Models" namespace
use App\Models\OnlineJob; // Updated to "Models" namespace
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;



class JobNoticeController extends Controller
{
    public function index() {
        $notices = JobNotice::orderBy('id', 'asc')->get();

        return view('admin.job_notice.all', compact('notices'));
    }

    public function add() {
        return view('admin.job_notice.add');
    }

    public function addPost(Request $request)
    {
//dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:job_notices', // Specify the table name here
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $job = new JobNotice();
            $job->title = $request->input('title');
            $job->slug = $request->input('slug');
            $job->status = $request->input('status');
            $job->description = $request->input('description');

            $job->save();

            return redirect()->route('admin.job.notice')->with('message', 'Job Notice added successfully.');
        } catch (Exception $exception) {
//            dd($exception);
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Exception: " . $exception->getMessage());
        }
    }


    public function edit(JobNotice $jobNotice)
    {
        return view('admin.job_notice.edit', compact('jobNotice'));
    }


    public function editPost(Request $request, $id)
    {
        // Fetch the job notice by ID
        $job = JobNotice::findOrFail($id);

        // Validate the input fields
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:job_notices,slug,' . $job->id, // Ensure slug is unique except for the current job notice
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            // Update the job notice attributes
            $job->title = $request->input('title');
            $job->slug = $request->input('slug');
            $job->status = $request->input('status');
            $job->description = $request->input('description');

            // Update the job notice in the database
            $job->update();

            return redirect()->route('admin.job.notice')->with('message', 'Job Notice updated successfully.');
        } catch (Exception $exception) {
            // Handle exception and redirect with error message
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Exception: " . $exception->getMessage());
        }
    }


    public function delete(Request $request) {
        $job = JobNotice::findOrFail($request->id); // Using findOrFail to handle cases where ID doesn't exist
        $job->delete();
    }

    public function jobApplyList() {
        $apply_list = OnlineJob::orderBy('id', 'desc')->get();
        return view('admin.job_notice.job_apply_list', compact('apply_list'));
    }

    public function jobApplyDelete(Request $request) {
        $job = OnlineJob::findOrFail($request->id); // Using findOrFail
        $job->delete();
    }

//    public function jobApply(Request $request)
//    {
//        // 🔍 Debugging: Request Data আসছে কিনা চেক করুন
//        // dd($request->all());
//
//        $request->validate([
//            'name' => 'required',
//            'father_name' => 'required',
//            'mother_name' => 'required',
//            'date_of_birth' => 'required|date',
//            'gender' => 'required|in:1,2',
//            'marital_status' => 'required|in:1,2,3,4',
//            'email' => 'required|email',
//            'mobile' => 'required|numeric',
//            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
//            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//
//        try {
//            $job = new OnlineJob();
//
//            // ✅ Photo Upload
//            if ($request->hasFile("photo")) {
//                $photo = $request->file("photo");
//                $photoName = time() . "_photo." . $photo->getClientOriginalExtension();
//                $photo->move(public_path('uploads/apply_job'), $photoName); // Public Path-এ রাখলাম
//                $job->photo = $photoName;
//            }
//
//            // ✅ CV Upload
//            if ($request->hasFile("cv")) {
//                $cv = $request->file("cv");
//                $cvName = time() . "_cv." . $cv->getClientOriginalExtension();
//                $cv->move(public_path('uploads/apply_job'), $cvName); // Public Path-এ রাখলাম
//                $job->cv = $cvName;
//            }
//
//            // ✅ Data Assign
//            $job->name = $request->input('name');
//            $job->father_name = $request->input('father_name');
//            $job->mother_name = $request->input('mother_name');
//            $job->date_of_birth = $request->input('date_of_birth');
//            $job->gender = $request->input('gender');
//            $job->marital_status = $request->input('marital_status');
//            $job->email = $request->input('email');
//            $job->mobile = $request->input('mobile');
//
//            $job->save(); // ✅ Save to Database
//
//            return redirect()->route('admin.job-applies')->with('message', 'Job application submitted successfully.');
//
//        } catch (Exception $exception) {
//            return redirect()->back()->withInput()->with("error", "Exception: " . $exception->getMessage());
//        }
//    }


    public function jobApply(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|integer|between:1,2',
            'martial_status' => 'required|integer|between:1,4',
            'national_id' => 'required|string|unique:online_jobs,national_id',
            'religion_status' => 'required|string|max:255',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'email' => 'required|email|unique:online_jobs,email',
            'mobile' => 'required|string|unique:online_jobs,mobile',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,docx,doc|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new job application
        $job = new OnlineJob();
        $job->name = $request->input('name');
        $job->father_name = $request->input('father_name');
        $job->mother_name = $request->input('mother_name');
        $job->date_of_birth = $request->input('date_of_birth');
        $job->gender = $request->input('gender');
        $job->martial_status = $request->input('martial_status');
        $job->national_id = $request->input('national_id');
        $job->religion_status = $request->input('religion_status');
        $job->present_address = $request->input('present_address');
        $job->permanent_address = $request->input('permanent_address');
        $job->email = $request->input('email');
        $job->mobile = $request->input('mobile');

        // Handle new photo upload (if provided)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $job->photo = $photoPath;
        }

        // Handle new CV upload (if provided)
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $job->cv = $cvPath;
        }

        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job application submitted successfully!');
    }






    public function jobApplyAdd(){
        return view('admin.job_notice.job_apply_add');
    }

//    public function jobApplyDetails() {
//        $job = OnlineJob::findOrFail($id); // Using findOrFail
//        return view('admin.job_notice.details', compact('job'));
//    }

    public function jobApplyDetails( $id)
    {
        $job = OnlineJob::findOrFail($id); // Using findOr
        return view('admin.job_notice.details', compact('job'));
}

}
