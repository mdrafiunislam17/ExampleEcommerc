<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClientTestimonial;  // Ensure you're using the correct namespace
use Exception;
use Faker\Provider\Image;
use Illuminate\Database\QueryException;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        try {
            $clientTestimonial = new ClientTestimonial();

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/uploads/Client", $imageName);
                $clientTestimonial->image = $imageName;
            }

            $clientTestimonial->name = $request->input('name');
            $clientTestimonial->designation = $request->input('designation');
            $clientTestimonial->description = $request->input('description');

            $clientTestimonial->save();

            return redirect()->route('admin.admin_all_client_testimonial')->with('message', 'Slider added successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional here
            'description' => 'required',
        ]);

        try {
            // Update basic fields
            $say->name = $request->input('name');
            $say->designation = $request->input('designation');
            $say->description = $request->input('description');

            // Check if new image is uploaded
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($say->image && Storage::exists('public/uploads/Client/' . $say->image)) {
                    Storage::delete('public/uploads/Client/' . $say->image);
                }

                // Store new image
                $image = $request->file('image');
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads/Client', $imageName);
                $say->image = $imageName;
            }

            $say->save();

            return redirect()->route('admin.admin_all_client_testimonial')->with('message', 'Testimonial updated successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'QueryException code: ' . $exception->getCode());
        }
    }




    public function delete(Request $request)
    {
        try {
            // AJAX থেকে প্রাপ্ত ID দিয়ে Slider খুঁজে বের করা
            $say = ClientTestimonial::findOrFail($request->id);

            // ইমেজ ডিলিট করার অংশ
            $imagePath = "public/uploads/Client/" . $say->image;
            if ($say->image && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $say->delete();

            return response()->json(['success' => true, 'message' => 'Slider deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

}
