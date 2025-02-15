<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory; // Updated to "Models" namespace
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('id', 'desc')->get();
        Log::debug($categories); // Log category data to verify 'status' values
        return view('admin.product_category.all', compact('categories'));
    }

    public function add()
    {
        return view('admin.product_category.add');
    }

    public function addPost(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sort' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric|min:0', // নতুন price validation
        ]);

        try {
            $category = new ProductCategory();
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->sort = $request->input('sort');
            $category->status = $request->input('status');
            $category->price = $request->input('price'); // Price যোগ করা হলো

            $category->save();

            return redirect()->route('admin.product.category')->with('message', 'Category added successfully.');
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Exception: " . $exception->getMessage());
        }
    }



    public function edit(ProductCategory $category)
    {
        return view('admin.product_category.edit', compact('category'));
    }

    public function editPost(Request $request, $id)
    {
        // dd($request->all()); // This will dump all the data sent in the form

        $request->validate([
            'name' => 'required|string|max:255',  // Ensure 'name' is unique
            'slug' => 'nullable|string|max:255',  // Allows 'slug' to be null or a string
            'sort' => 'required|integer|min:1',  // Ensure 'sort' is a positive integer
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $category = ProductCategory::findOrFail($id);  // Retrieve the category by ID

            // Update category properties
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->sort = $request->input('sort');
            $category->status = $request->input('status');

            $category->save();  // Save updated data

            return redirect()->route('admin.product.category')->with('message', 'Category updated successfully.');
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Exception: " . $exception->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            // AJAX থেকে প্রাপ্ত ID দিয়ে Slider খুঁজে বের করা
            $category = ProductCategory::findOrFail($request->id);


            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $category->delete();

            return response()->json(['success' => true, 'message' => 'Brand deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }

    }


}
