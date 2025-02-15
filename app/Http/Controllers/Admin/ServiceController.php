<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;  // Updated to "Models" namespace
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Intervention\Image\Facades\Image;  // Updated for image handling

class ServiceController extends Controller
{
    public function index() {
        $services = Service::orderBy('sort', 'asc')->paginate(15);

        return view('admin.service.all', compact('services'));
    }

    public function add() {
        return view('admin.service.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'image' => 'nullable|image',
            'show_home' => 'nullable|max:1',
            'sort' => 'required|max:2',
        ]);

        $filename = '';
        if ($request->image) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/service';
            $file->move($destinationPath, $filename);

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(360, 225);
            $img->save(public_path('uploads/service/thumbs/' . $filename), 50);
        }

        $service = new Service();
        $service->name = $request->name;
        $service->sort = $request->sort;
        $service->description = $request->description;
        $service->show_home = ($request->show_home) ? 1 : 0;
        $service->image = $filename;
        $service->save();

        return redirect()->route('admin_all_service')->with('message', 'Service added successfully.');
    }

    public function edit(Service $service) {
        return view('admin.service.edit', compact('service'));
    }

    public function editPost(Service $service, Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'image' => 'nullable|image',
            'show_home' => 'nullable|max:1',
            'sort' => 'required|max:2',
        ]);

        if ($request->image) {
            //unlink('public/uploads/service/'.$service->image);

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/service';
            $file->move($destinationPath, $filename);

            $service->image = $filename;

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->save(public_path('uploads/service/thumbs/' . $filename), 100);
        }

        $service->name = $request->name;
        $service->sort = $request->sort;
        $service->description = $request->description;
        $service->show_home = ($request->show_home) ? 1 : 0;
        $service->save();

        return redirect()->route('admin_all_service')->with('message', 'Service updated successfully.');
    }

    public function delete(Request $request) {
        $service = Service::find($request->id);
        // Uncomment to delete the image if necessary
        // unlink('public/uploads/service/'.$service->image);
        $service->delete();
    }
}
