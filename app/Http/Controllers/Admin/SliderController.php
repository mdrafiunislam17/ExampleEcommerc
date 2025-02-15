<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class SliderController extends Controller
{
    public function index() {
        $sliders = Slider::orderBy('sort')->get();

        return view('admin.slider.all', compact('sliders'));
    }

    public function add() {
        return view('admin.slider.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'heading' => 'max:191',
            'subheading' => 'max:191',
            'sort' => 'required|integer|min:1',
        ]);

        try {
            $slider = new Slider();

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/uploads/slider", $imageName);
                $slider->image = $imageName;
            }

            $slider->heading = $request->input('heading');
            $slider->subheading = $request->input('subheading');
            $slider->sort = $request->input('sort');

            $slider->save();

            return redirect()->route('admin.admin_all_slider')->with('message', 'Slider added successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }
    }


    public function edit(Slider $slider) {
        return view('admin.slider.edit', compact('slider'));
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'heading' => 'max:191',
            'subheading' => 'max:191',
            'sort' => 'required|integer|min:1',
        ]);

        try {
            $slider = Slider::findOrFail($id);

            if ($request->hasFile("image")) {
                // Delete the old image if exists
                if ($slider->image && file_exists(storage_path("app/public/uploads/slider/" . $slider->image))) {
                    unlink(storage_path("app/public/uploads/slider/" . $slider->image));
                }

                $image = $request->file("image");
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/uploads/slider", $imageName);
                $slider->image = $imageName;
            }

            $slider->heading = $request->input('heading');
            $slider->subheading = $request->input('subheading');
            $slider->sort = $request->input('sort');

            $slider->save();

            return redirect()->route('admin.admin_all_slider')->with('message', 'Slider updated successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }
    }


//    public function delete(Request $request, $id)
//    {
//        try {
//            $slider = Slider::findOrFail($id);
//
//            $imagePath = $slider->image;
//
//            if ($imagePath && Storage::exists("public/uploads/slider/" . $imagePath)) {
//                Storage::delete("public/uploads/slider/" . $imagePath);
//            }
//
//            $slider->delete();
//
//            return redirect()->back()->with("success", "Slider has been deleted successfully.");
//        } catch (Exception $exception) {
//            return redirect()->back()->with("error", $exception->getMessage());
//        }
//    }


    public function delete(Request $request)
    {
        try {
            // AJAX থেকে প্রাপ্ত ID দিয়ে Slider খুঁজে বের করা
            $slider = Slider::findOrFail($request->id);

            // ইমেজ ডিলিট করার অংশ
            $imagePath = "public/uploads/slider/" . $slider->image;
            if ($slider->image && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            // ডাটাবেজ থেকে স্লাইডার ডিলিট
            $slider->delete();

            return response()->json(['success' => true, 'message' => 'Slider deleted successfully!']);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

}
