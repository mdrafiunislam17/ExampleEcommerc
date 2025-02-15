<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    //
    public function index() {
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('admin.brand.all', compact('brands'));
    }

    public function add() {
        return view('admin.brand.add');
    }

    public function addPost(Request $request)
    {
        // Validate the form data
       $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:brands,slug|max:255', // Ensure slug uniqueness in the 'brands' table
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate logo if provided
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive', // Status should be either 'active' or 'inactive'
        ]);



        try {
            // Create a new Brand instance
            $brand = new Brand();

            // Handle logo upload if present
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->storeAs('public/uploads/brand', $logoName);
                $brand->logo = $logoName; // Store the logo file name
            }

            // Assign values to the brand model
            $brand->name = $request->input('name'); // Set brand name
            $brand->slug = $request->input('slug'); // Set slug
            $brand->description = $request->input('description'); // Set description (nullable)
            $brand->status = $request->input('status'); // Set status (active/inactive)

            // Save the brand to the database
            $brand->save();

            // Commit the transaction
            return redirect()->route('admin.brand')->with('message', 'Brand added successfully.');

        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }
    }



    public function edit(Brand $brand) {
        return view('admin.brand.edit', compact('brand'));
    }

    public function editPost(Request $request, Brand $brand) {
        // Validate the form data
        $request->validate([
            'name' => 'required|max:255',
            'slug' => [
                'required',
                'max:255',
                Rule::unique('brands')->ignore($brand->id), // Ensure slug uniqueness, but ignore the current brand
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle logo upload if present
        $logoPath = $brand->logo; // Keep the existing logo if not updating
        if ($request->hasFile('logo')) {
            // Delete the old logo if it's being replaced
            if ($logoPath) {
                Storage::delete('public/' . $logoPath);
            }
            // Store the new logo
            $logoPath = $request->file('logo')->store('uploads/brand', 'public');
        }

        // Update the brand information
        $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'logo' => $logoPath,
        ]);

        // Redirect back to the brand listing page with a success message
        return redirect()->route('admin.brand')->with('message', 'Brand updated successfully.');
    }

    public function delete(Request $request)
    {
        try {
            // AJAX থেকে প্রাপ্ত ID দিয়ে Slider খুঁজে বের করা
            $brand = Brand::findOrFail($request->id);

            // ইমেজ ডিলিট করার অংশ
            $logo = "public/uploads/brand/" . $brand->image;
            if ($brand->image && Storage::exists($logo)) {
                Storage::delete($logo);
            }

            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $brand->delete();

            return response()->json(['success' => true, 'message' => 'Brand deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

}
