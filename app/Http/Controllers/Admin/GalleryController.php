<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryItem;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryItem::orderBy('id', 'desc')->paginate(8);
        return view('admin.gallery.all', compact('images'));
    }

    public function add()
    {
        return view('admin.gallery.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required|max:255',
        ]);

        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/gallery/' . $filename;

        // Store Original Image
        $file->move(public_path('uploads/gallery'), $filename);

        // Create Thumbnail
        $thumbnailPath = 'uploads/gallery/thumbs/' . $filename;
        $img = Image::make(public_path($path))->resize(370, 250);
        $img->save(public_path($thumbnailPath), 70);

        // Save to Database
        GalleryItem::create([
            'title' => $request->title,
            'image' => $filename
        ]);

        return redirect()->route('admin.gallery.index')->with('message', 'Gallery item added successfully.');
    }

    public function edit(GalleryItem $item)
    {
        return view('admin.gallery.edit', compact('item'));
    }

    public function editPost(GalleryItem $item, Request $request)
    {
        $request->validate([
            'image' => 'image',
            'title' => 'required|max:255',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/gallery/' . $filename;

            // Store New Image
            $file->move(public_path('uploads/gallery'), $filename);

            // Create New Thumbnail
            $thumbnailPath = 'uploads/gallery/thumbs/' . $filename;
            $img = Image::make(public_path($path))->resize(370, 250);
            $img->save(public_path($thumbnailPath), 70);

            // Delete Old Image
            if ($item->image) {
                unlink(public_path('uploads/gallery/' . $item->image));
                unlink(public_path('uploads/gallery/thumbs/' . $item->image));
            }

            $item->image = $filename;
        }

        $item->title = $request->title;
        $item->save();

        return redirect()->route('admin.gallery.index')->with('message', 'Gallery item updated successfully.');
    }

    public function delete(Request $request)
    {
        $item = GalleryItem::find($request->id);

        if ($item) {
            unlink(public_path('uploads/gallery/' . $item->image));
            unlink(public_path('uploads/gallery/thumbs/' . $item->image));
            $item->delete();
        }

        return redirect()->route('admin.gallery.index')->with('message', 'Gallery item deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/gallery/' . $filename;

        // Store Image
        $file->move(public_path('uploads/gallery'), $filename);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $filename,
                'fullPath' => asset($path),
                'path' => $path
            ]
        ]);
    }
}
