<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClientTestimonial;  // Ensure you're using the correct namespace
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class ClientTestimonialController extends Controller
{
    public function index()
    {
        $says = ClientTestimonial::orderBy('id', 'desc')->get();
        return view('admin.client_testimonial.all', compact('says'));
    }

    public function add()
    {
        return view('admin.client_testimonial.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'nullable|max:255',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads/client_testimonial');
            $file->move($destinationPath, $filename);

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(110, 75);
            $img->save(storage_path('app/public/uploads/client_testimonial/thumbs/' . $filename), 60);
        }

        $say = new ClientTestimonial();
        $say->name = $request->name;
        $say->designation = $request->designation;
        $say->description = $request->description;
        $say->image = $filename;
        $say->save();

        return redirect()->route('admin_all_client_testimonial')->with('message', 'Client testimonial added successfully.');
    }

    public function edit(ClientTestimonial $say)
    {
        return view('admin.client_testimonial.edit', compact('say'));
    }

    public function editPost(ClientTestimonial $say, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'nullable|max:255',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image files if a new image is uploaded
            if (Storage::exists('public/uploads/client_testimonial/' . $say->image)) {
                Storage::delete('public/uploads/client_testimonial/' . $say->image);
                Storage::delete('public/uploads/client_testimonial/thumbs/' . $say->image);
            }

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads/client_testimonial');
            $file->move($destinationPath, $filename);

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(110, 75);
            $img->save(storage_path('app/public/uploads/client_testimonial/thumbs/' . $filename), 60);

            $say->image = $filename;
        }

        $say->name = $request->name;
        $say->designation = $request->designation;
        $say->description = $request->description;
        $say->save();

        return redirect()->route('admin_all_client_testimonial')->with('message', 'Client testimonial updated successfully.');
    }

    public function delete(Request $request)
    {
        $say = ClientTestimonial::find($request->id);

        // Delete image files
        if ($say) {
            Storage::delete('public/uploads/client_testimonial/' . $say->image);
            Storage::delete('public/uploads/client_testimonial/thumbs/' . $say->image);
            $say->delete();
        }

        return redirect()->route('admin_all_client_testimonial')->with('message', 'Client testimonial deleted successfully.');
    }
}
