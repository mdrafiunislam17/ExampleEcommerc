<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssociationWebLink; // Use App\Models
use Exception;
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
            'web_url' => 'required|url|max:255|unique:association_web_links,web_url', // Added unique validation
        ]);

        $link = new AssociationWebLink();
        $link->name = $request->input('name');
        $link->web_url = $request->input('web_url');
        $link->save();

        return redirect()->route('admin.association_web_url')->with('message', 'Association web URL added successfully.');
    }


    // Show the edit form with the existing link
    public function edit(AssociationWebLink $link) {
        return view('admin.association_link.edit', compact('link'));
    }

    // Handle the form submission to update the link
    public function editPost(Request $request, $id) {
        // রেকর্ড খুঁজে বের করো
        $link = AssociationWebLink::findOrFail($id);

        // ফর্ম ভ্যালিডেশন
        $request->validate([
            'name' => 'required|max:255',
            'web_url' => "required|url|max:255|unique:association_web_links,web_url,{$id}", // Ensure uniqueness except for the current record
        ]);

        // ডাটা আপডেট করো
        $link->name = $request->input('name');
        $link->web_url = $request->input('web_url');
        $link->save();

        // সফল মেসেজ সহ রিডাইরেক্ট
        return redirect()->route('admin.association_web_url')->with('message', 'Association web URL updated successfully.');
    }


    // Handle the delete operation

    public function delete(Request $request)
    {
        try {
            $link = AssociationWebLink::find($request->id);

            if (!$link) {
                return response()->json(['success' => false, 'message' => 'Link not found!'], 404);
            }

            $link->delete();

            return response()->json(['success' => true, 'message' => 'Link deleted successfully!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }


}
