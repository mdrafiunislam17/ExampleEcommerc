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
        $category->name = $request->name;
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('customer.category')->with('message', 'Category added successfully.');
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
            'name' => 'required|string|max:255|unique:customer_categories,name,' . $category->id, // Ignore current category id for uniqueness
            'sort' => 'required|integer|min:1',
            'status' => 'required|boolean', // Ensure status is boolean
        ]);

        // Update category details
        $category->name = $request->name;
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->slug = null; // You can implement slug generation logic if required
        $category->save();

        return redirect()->route('customer.category')->with('message', 'Category updated successfully.');
    }
}
