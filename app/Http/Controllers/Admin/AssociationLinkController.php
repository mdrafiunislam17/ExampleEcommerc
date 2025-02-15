<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssociationWebLink; // Use App\Models
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssociationLinkController extends Controller
{
    // Show the list of association web links
    public function index() {
        $links = AssociationWebLink::orderBy('id', 'desc')->get();

        return view('admin.association_link.all', compact('links'));
    }

    // Show the add link form
    public function add() {
        return view('admin.association_link.add');
    }

    // Handle the form submission to add a new link
    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'web_url' => 'required|url|max:255', // Added url validation
        ]);

        $link = new AssociationWebLink();
        $link->name = $request->name;
        $link->web_url = $request->web_url;
        $link->save();

        return redirect()->route('admin_association_web_url')->with('message', 'Association web URL added successfully.');
    }

    // Show the edit form with the existing link
    public function edit(AssociationWebLink $link) {
        return view('admin.association_link.edit', compact('link'));
    }

    // Handle the form submission to update the link
    public function editPost(AssociationWebLink $link, Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'web_url' => 'required|url|max:255', // Added url validation
        ]);

        $link->name = $request->name;
        $link->web_url = $request->web_url;
        $link->save();

        return redirect()->route('admin_association_web_url')->with('message', 'Association web URL updated successfully.');
    }

    // Handle the delete operation
    public function delete(Request $request) {
        $link = AssociationWebLink::find($request->id);

        if ($link) {
            $link->delete();
            return response()->json(['message' => 'Association web URL deleted successfully.']);
        }

        return response()->json(['message' => 'Link not found.'], 404);
    }
}
