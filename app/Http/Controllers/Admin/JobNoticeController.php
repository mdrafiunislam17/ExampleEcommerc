<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobNotice; // Updated to "Models" namespace
use App\Models\OnlineJob; // Updated to "Models" namespace
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function jobApplyDetails() {
        $job = OnlineJob::findOrFail($id); // Using findOrFail
        return view('admin.job_notice.details', compact('job'));
    }
}
