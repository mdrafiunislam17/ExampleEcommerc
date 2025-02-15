<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product; // Updated to "Models" namespace
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Service;
use Exception;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category', 'brand')->orderBy('id', 'desc')->get();
        Log::debug($products);
        return view('admin.product.all', compact('products'));
    }


    public function add() {
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();

        return view('admin.product.add', compact('categories', 'brands'));
    }



    public function addPost(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0', // Ensure price is numeric
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $product = new Product();
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');
            $product->brand_id = $request->input('brand_id');
            $product->description = $request->input('description');
            $product->slug = $request->input('slug');

            // Ensure price is treated as a numeric value (float or integer)
            $product->price = is_numeric($request->input('price')) ? (float)$request->input('price') : 0.0;

            $product->status = $request->input('status');

            $product->save();

            return redirect()->route('admin.products')->with('message', 'Product added successfully.');
        } catch (\Exception $exception) {

            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Exception: " . $exception->getMessage());
        }
    }








    public function edit(Product $product)
    {
        $categories = ProductCategory::all(); // Fetch all categories from the database
        $brands = Brand::all(); // Fetch all brands from the database

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }


    public function editPost(Product $product, Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0', // Ensure price is numeric
            'status' => 'required|in:active,inactive',
        ]);

        try {
            // Update the product with the request data
            $product->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'brand_id' => $request->input('brand_id'),
                'description' => $request->input('description'),
                'slug' => $request->input('slug'),
                'price' => is_numeric($request->input('price')) ? (float)$request->input('price') : 0.0,
                'status' => $request->input('status'),
            ]);

            // Redirect with success message
            return redirect()->route('admin.products')->with('message', 'Product updated successfully.');
        } catch (\Exception $exception) {
            // Handle any exception and redirect with error message
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
            $category = Product::findOrFail($request->id);


            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $category->delete();

            return response()->json(['success' => true, 'message' => 'Brand deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }

    }


}
