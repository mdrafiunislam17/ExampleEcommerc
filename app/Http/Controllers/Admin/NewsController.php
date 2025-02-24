<?php

namespace App\Http\Controllers\Admin;

use App\Models\News; // Updated to "Models" namespace
use Exception;
use Faker\Provider\Image;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class NewsController extends Controller
{
    public function index() {
        $news = News::orderBy('id', 'desc')->get();

        return view('admin.news_event.all', compact('news'));
    }

    public function add() {
        return view('admin.news_event.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);
        try {
            $news = new News();

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/uploads/news", $imageName);
                $news->image = $imageName;
            }

            $news->name = $request->input('name');
            $news->description = $request->input('description');

            $news->save();

            return redirect()->route('admin.news.index')->with('message', 'Slider added successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }

    }

    public function edit(News $news) {
        return view('admin.news_event.edit', compact('news'));
    }

    public function editPost(News $news, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        try {
            // Update name & description
            $news->name = $request->input('name');
            $news->description = $request->input('description');

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads/news', $imageName);

                // Delete old image if exists
                if ($news->image) {
                    $oldImagePath = public_path('storage/uploads/news/' . $news->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Save new image name
                $news->image = $imageName;
            }

            $news->save();

            return redirect()->route('admin.news.index')->with('message', 'News updated successfully.');
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
            $news = News::findOrFail($request->id);

            // ইমেজ ডিলিট করার অংশ
            $imagePath = "public/uploads/news/" . $news->image;
            if ($news->image && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $news->delete();

            return response()->json(['success' => true, 'message' => 'Slider deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }
}
