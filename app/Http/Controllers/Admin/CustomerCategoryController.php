<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerCategory; // Correct namespace
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerCategoryController extends Controller
{
    public function index()
    {
        // Fetch all customer categories, ordered by ID in descending order
        $categories = CustomerCategory::orderBy('id', 'desc')->get();
        return view('admin.customer_category.all', compact('categories'));
    }

    public function add()
    {
        return view('admin.customer_category.add');
    }

    public function addPost(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:customer_categories', // Ensure name is unique
            'sort' => 'required|integer|min:1',
            'status' => 'required|boolean', // Ensure status is boolean
        ]);

        // Create a new category record
        $category = new CustomerCategory();
        $category->name = $request->input('name');
        $category->sort = $request->input('sort');
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('admin.customer.category')->with('message', 'Category added successfully.');
    }

    public function edit(CustomerCategory $category)
    {
        // Return view with existing category data
        return view('admin.customer_category.edit', compact('category'));
    }



    public function editPost(CustomerCategory $category, Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:customer_categories,name,' . $category->id,
            'sort' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ]);

//        // Find the category and update it
//        $category = CustomerCategory::findOrFail($category);
        $category->name = $request->input('name');
        $category->sort = $request->input('sort');
        $category->status = $request->input('status');
        $category->save();

        // Redirect with success message
        return redirect()->route('admin.customer.category')->with('message', 'Category updated successfully.');
    }

    public function delete(Request $request) {
        $job = CustomerCategory::findOrFail($request->id); // Using findOrFail to handle cases where ID doesn't exist
        $job->delete();
    }

}
