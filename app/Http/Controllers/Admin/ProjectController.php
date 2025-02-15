<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;  // Updated to "Models" namespace
use App\Models\Project;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::orderBy('id', 'desc')->paginate(15);

        return view('admin.project.all', compact('projects'));
    }

    public function add() {
        return view('admin.project.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name_of_contact' => 'required|max:255',
            'contact_no' => 'required|max:255',
            'image' => 'nullable|image',
            'client' => 'required|max:255',
            'project_name' => 'required|max:255',
            'work_order_value' => 'required|max:255',
        ]);

        $filename = '';
        if ($request->image) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/project';
            $file->move($destinationPath, $filename);

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(400, 400);
            $img->save(public_path('uploads/project/thumbs/' . $filename), 50);
        }

        $project = new Project();
        $project->name_of_contact = $request->name_of_contact;
        $project->contact_no = $request->contact_no;
        $project->client = $request->client;
        $project->project_name = $request->project_name;
        $project->work_order_value = $request->work_order_value;
        $project->image = $filename;
        $project->save();

        return redirect()->route('admin_all_project')->with('message', 'Project added successfully.');
    }

    public function edit(Project $project) {
        $sectors = DB::table('sub_menus')->where('menu_id', '=', '3')->orderBy('sort', 'asc')->get();
        $clients = Client::orderBy('id', 'desc')->get();

        return view('admin.project.edit', compact('project', 'sectors', 'clients'));
    }

    public function editPost(Project $project, Request $request) {
        $request->validate([
            'name_of_contact' => 'required|max:255',
            'contact_no' => 'required|max:255',
            'image' => 'nullable|image',
            'client' => 'required|max:255',
            'project_name' => 'required|max:255',
            'work_order_value' => 'required|max:255',
        ]);

        if ($request->image) {
            // Uncomment to delete old image if necessary
            // unlink('public/uploads/project/' . $project->image);

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/project';
            $file->move($destinationPath, $filename);

            $project->image = $filename;

            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(400, 400);
            $img->save(public_path('uploads/project/thumbs/' . $filename), 50);
        }

        $project->name_of_contact = $request->name_of_contact;
        $project->contact_no = $request->contact_no;
        $project->client = $request->client;
        $project->project_name = $request->project_name;
        $project->work_order_value = $request->work_order_value;
        $project->save();

        return redirect()->route('admin_all_project')->with('message', 'Project updated successfully.');
    }

    public function delete(Request $request) {
        $project = Project::find($request->id);
        // Uncomment to delete the image if necessary
        // unlink('public/uploads/project/' . $project->image);
        $project->delete();
    }
}
