<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;  // Updated to "Models" namespace
use App\Models\ProductSubCategory;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSubCategoryController extends Controller
{
    public function index() {
        $subCategories = ProductSubCategory::orderBy('sort')->with('service', 'category')->get();

        return view('admin.product_sub_category.all', compact('subCategories'));
    }

    public function add() {
        $services = Service::orderBy('sort')->get();
        $categories = ProductCategory::orderBy('sort')->get();

        return view('admin.product_sub_category.add', compact('categories', 'services'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'business' => 'required',
            'category' => 'required',
            'name' => 'required|string|max:255',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $subCategory = new ProductSubCategory();
        $subCategory->service_id = $request->business;
        $subCategory->product_category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->sort = $request->sort;
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('product_sub_category')->with('message', 'Product Sub Category added successfully.');
    }

    public function edit(ProductSubCategory $subCategory) {
        $services = Service::orderBy('sort')->get();

        return view('admin.product_sub_category.edit', compact('subCategory', 'services'));
    }

    public function editPost(ProductSubCategory $subCategory, Request $request) {
        $request->validate([
            'business' => 'required',
            'category' => 'required',
            'name' => 'required|string|max:255',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $subCategory->service_id = $request->business;
        $subCategory->product_category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->sort = $request->sort;
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('product_sub_category')->with('message', 'Product Sub Category updated successfully.');
    }

    public function getSubCategory(Request $request) {
        $subCategories = ProductCategory::where('service_id', $request->businessId)
            ->orderBy('sort')
            ->get()
            ->toArray();

        return response()->json($subCategories);
    }
}
