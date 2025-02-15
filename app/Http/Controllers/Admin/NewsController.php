<?php

namespace App\Http\Controllers\Admin;

use App\Models\News; // Updated to "Models" namespace
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            // Upload Image
            $file = $request->file('image');
            $filename = Guid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/news';
            $file->move($destinationPath, $filename);

            // Thumbnails
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(364, 254);
            $img->save(public_path('uploads/news/thumbs/' . $filename), 50);
        }

        $news = new News();
        $news->name = $request->name;
        $news->description = $request->description;
        $news->image = $filename;
        $news->save();

        return redirect()->route('admin_all_news')->with('message', 'News/Event added successfully.');
    }

    public function edit(News $news) {
        return view('admin.news_event.edit', compact('news'));
    }

    public function editPost(News $news, Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists (use unlink)
            if ($news->image) {
                unlink(public_path('uploads/news/' . $news->image));
                unlink(public_path('uploads/news/thumbs/' . $news->image)); // Deleting the thumbnail
            }

            $file = $request->file('image');
            $filename = Guid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/news';
            $file->move($destinationPath, $filename);

            $news->image = $filename;

            // Thumbnails
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(364, 254);
            $img->save(public_path('uploads/news/thumbs/' . $filename), 50);
        }

        $news->name = $request->name;
        $news->description = $request->description;
        $news->save();

        return redirect()->route('admin_all_news')->with('message', 'News/Event updated successfully.');
    }

    public function delete(Request $request) {
        $news = News::findOrFail($request->id);

        // Delete associated files
        if ($news->image) {
            unlink(public_path('uploads/news/' . $news->image));
            unlink(public_path('uploads/news/thumbs/' . $news->image)); // Deleting the thumbnail
        }

        $news->delete();
    }
}
