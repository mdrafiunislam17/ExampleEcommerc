<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;  // Updated to "Models" namespace
use Faker\Provider\Image;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::orderBy('sort')->get();

        return view('admin.team.all', compact('teams'));
    }

    public function add() {
        return view('admin.team.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'title' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort' => 'required|max:2',
        ]);
        try {
            $team = new Team();

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/uploads/ream", $imageName);
                $team->image = $imageName;
            }
            $team->title = $request->input('title'); // ✅ Title সেভ করা হয়েছে
            $team->sort = $request->input('sort');

            $team->save();

            return redirect()->route('admin.admin_all_team')->with('message', 'Slider added successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "QueryException code: " . $exception->getCode());
        }



    }

    public function edit(Team $team) {
        return view('admin.team.edit', compact('team'));
    }

    public function editPost(Team $team, Request $request) {
        $request->validate([
            'title' => 'nullable|max:255',
            'image' => 'nullable|image',
            'sort' => 'required|max:2',
        ]);

        if ($request->image) {
            //unlink('public/uploads/project/'.$project->image);

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/team';
            $file->move($destinationPath, $filename);

            $team->image = $filename;
            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(400, 400);
            $img->save(public_path('uploads/team/thumbs/' . $filename), 60);
        }

        $team->title = $request->title;
        $team->sort = $request->sort;
        $team->save();

        return redirect()->route('admin_all_team')->with('message', 'Team Image updated successfully.');
    }

    public function delete(Request $request) {
        $team = Team::find($request->id);
        //unlink('public/uploads/project/'.$project->image);
        $team->delete();
    }
}
