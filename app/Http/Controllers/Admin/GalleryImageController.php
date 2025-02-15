<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery; // Updated namespace to "Models"
use App\Models\GalleryImage; // Updated namespace to "Models"
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Ramsey\Uuid\Guid\Guid;

class GalleryImageController extends Controller
{
    public function index() {
        $galleries = Gallery::with('images')->orderBy('id', 'desc')->get();

        return view('admin.gallery_image.all', compact('galleries'));
    }

    public function add() {
        return view('admin.gallery_image.add');
    }

    public function addPost(Request $request)
    {
        $messages = [
            'imagesId.required' => 'At least one image is required.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'imagesId' => 'required|array', // নিশ্চিত করো যে এটি একটি অ্যারে
        ], $messages);

        // নতুন গ্যালারি তৈরি
        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->save();

        // ইমেজ প্রসেস করা হচ্ছে
        if ($request->imagesId) {
            foreach ($request->imagesId as $index => $imageId) {
                $image = GalleryImage::findOrFail($imageId); // এটি 404 ত্রুটি দিবে যদি ছবিটি না পাওয়া যায়


                if (!$image) {
                    \Log::error('Image not found', ['imageId' => $imageId]);
                    return back()->withErrors(['imagesId' => 'One or more selected images not found.']);
                }


                $filename = Str::uuid()->toString(); // Unique ফাইল নাম তৈরি
                $ext = pathinfo($image->path, PATHINFO_EXTENSION);

                $thumbsSavePath = 'uploads/gallery/thumbs/' . $filename . '.' . $ext;

                // Generate thumbnail
                $thumb = Image::make(public_path($image->path))->resize(360, 241);
                $thumb->save(public_path($thumbsSavePath), 50);

                // ডাটাবেজ আপডেট
                $image->gallery_id = $gallery->id;
                $image->sort = $index + 1;
                $image->thumbs = $thumbsSavePath;
                $image->save();
            }
        }

        return redirect()->route('gallery-images.index')->with('message', 'Gallery added successfully.');
    }



    public function edit(Gallery $gallery) {
        return view('admin.gallery_image.edit', compact('gallery'));
    }

    public function editPost(Gallery $gallery, Request $request) {
        $messages = [
            'imagesId.required' => 'At least one image is required.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'imagesId' => 'required',
        ], $messages);

        $gallery->title = $request->title;
        $gallery->save();

        if ($request->imagesId) {
            foreach ($request->imagesId as $index => $imageId) {
                $image = GalleryImage::findOrFail($imageId);

                if (is_null($image->product_id) || is_null($image->thumbs)) {
                    $filename = Guid::uuid4()->toString();
                    $ext = pathinfo($image->path, PATHINFO_EXTENSION);

                    $thumbsSavePath = 'uploads/gallery/thumbs/' . $filename . '.' . $ext;

                    // Generate thumbnail
                    $thumb = Image::make(public_path($image->path))->resize(360, 241);
                    $thumb->save(public_path($thumbsSavePath), 50);

                    $image->thumbs = $thumbsSavePath;
                }

                $image->gallery_id = $gallery->id;
                $image->sort = $index + 1;
                $image->save();
            }

            // Delete images that are no longer associated with the gallery
            $images = GalleryImage::where('gallery_id', $gallery->id)
                ->whereNotIn('id', $request->imagesId)
                ->get();

            foreach ($images as $image) {
                if ($image->path) {
                    unlink(public_path($image->path));
                }

                if ($image->thumbs) {
                    unlink(public_path($image->thumbs));
                }

                $image->delete();
            }
        }

        return redirect()->route('galleries')->with('message', 'Gallery edited successfully.');
    }

    public function uploadImage(Request $request) {
        $request->validate([
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $filename = Guid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
        $destinationPath = 'public/uploads/gallery';
        $file->move($destinationPath, $filename);

        $path = 'uploads/gallery/' . $filename;

        $image = GalleryImage::create([
            'path' => $path
        ]);

        $image->fullPath = asset($path);

        return response()->json(['success' => true, 'data' => $image->toArray()]);
    }
}
