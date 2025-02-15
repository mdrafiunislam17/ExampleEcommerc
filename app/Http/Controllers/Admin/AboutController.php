<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Faker\Provider\Image;

class AboutController extends Controller
{
    public function index() {
        $about = About::where('id', 1)->first();
        return view('admin.about.all', compact('about'));
    }

    public function edit(About $about) {
        return view('admin.about.edit', compact('about'));
    }

    public function editPost(About $about, Request $request) {
        $request->validate([
            'text' => 'required|max:5000',
            'text2' => 'required|max:5000',
            'image' => 'nullable|image',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($about->image && Storage::exists('public/uploads/about/'.$about->image)) {
                Storage::delete('public/uploads/about/'.$about->image);
                Storage::delete('public/uploads/about/thumbs/'.$about->image);
            }

            // Store the new image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . 'Controllers' .$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/about';

            // Store the original image
            $file->storeAs($destinationPath, $filename);

            // Generate and store the thumbnail
            $img = Image::make($file);
            $img->resize(470, 440);
            $img->save(Storage::path('public/uploads/about/thumbs/'.$filename), 100);

            // Update the image field in the database
            $about->image = $filename;
        }

        // Update the text fields
        $about->text = $request->text;
        $about->text2 = $request->text2;
        $about->save();

        return redirect()->route('admin_all_about')->with('message', 'About Us updated successfully.');
    }
}
