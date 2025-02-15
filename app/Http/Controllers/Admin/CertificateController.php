<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;  // Make sure you're using the correct namespace
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Faker\Provider\Image;
use Ramsey\Uuid\Uuid;


class CertificateController extends Controller
{
    public function index() {
        $certificates = Certificate::orderBy('id','desc')->get();
        return view('admin.certificate.all', compact('certificates'));
    }

    public function add() {
        return view('admin.certificate.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'title' => 'nullable|max:255',
            'image' => 'required|image',
        ]);

        // Handle file upload
        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/uploads/certificate');  // Updated path for storage
        $file->move($destinationPath, $filename);

        // Generate thumbnail
        $img = Image::make($destinationPath.'/'.$filename);
        $img->resize(370, 250);
        $img->save(storage_path('app/public/uploads/certificate/thumbs/'.$filename), 50);

        // Save certificate info to DB
        $certificate = new Certificate();
        $certificate->title = $request->title;
        $certificate->image = $filename;
        $certificate->save();

        return redirect()->route('admin_all_certificate')->with('message', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate) {
        return view('admin.certificate.edit', compact('certificate'));
    }

    public function editPost(Certificate $certificate, Request $request) {
        $request->validate([
            'title' => 'nullable|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if a new one is uploaded
            if (Storage::exists('public/uploads/certificate/'.$certificate->image)) {
                Storage::delete('public/uploads/certificate/'.$certificate->image);
                Storage::delete('public/uploads/certificate/thumbs/'.$certificate->image);
            }

            // Handle new file upload
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads/certificate');
            $file->move($destinationPath, $filename);

            // Generate thumbnail
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(370, 250);
            $img->save(storage_path('app/public/uploads/certificate/thumbs/'.$filename), 50);

            $certificate->image = $filename;
        }

        // Update certificate title
        $certificate->title = $request->title;
        $certificate->save();

        return redirect()->route('admin_all_certificate')->with('message', 'Certificate updated successfully.');
    }

    public function delete(Request $request) {
        $certificate = Certificate::find($request->id);

        // Delete associated image and thumbnail
        if ($certificate) {
            Storage::delete('public/uploads/certificate/'.$certificate->image);
            Storage::delete('public/uploads/certificate/thumbs/'.$certificate->image);
            $certificate->delete();
        }

        return redirect()->route('admin_all_certificate')->with('message', 'Certificate deleted successfully.');
    }
}
