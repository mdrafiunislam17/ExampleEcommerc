<?php

namespace App\Http\Controllers;

use App\Models\OnlineJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OnlineJobController extends Controller
{
    public function index()
    {
        $apply_list = OnlineJob::all();
        return view('admin.job_notice.job_apply_list', compact('apply_list'));
    }

    public function create()
    {
        return view('admin.job_notice.job_apply_add');
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|integer|between:1,2',
            'martial_status' => 'required|integer|between:1,4',
            'national_id' => 'required|string|unique:online_jobs',
            'religion_status' => 'required|string|max:255',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'email' => 'required|email|unique:online_jobs',
            'mobile' => 'required|string|unique:online_jobs',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'file|mimes:pdf,docx,doc|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $job->photo = $photoPath;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $job->cv = $cvPath;
        }

        $job->save();

        return redirect()->route('admin.jobs')->with('success', 'Job application submitted successfully!');
    }

    public function destroy($id)
    {
        $job = OnlineJob::findOrFail($id);

        // Delete the associated files if they exist
        if ($job->photo) {
            Storage::disk('public')->delete($job->photo);
        }
        if ($job->cv) {
            Storage::disk('public')->delete($job->cv);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
