<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;  // Ensure you're using the correct namespace
use App\Models\CustomerCategory;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function allClient()
    {
        $clients = Client::orderBy('id', 'desc')->get();
        return view('admin.client.all_client', compact('clients'));
    }

    public function addClientForm()
    {
        $categories = CustomerCategory::where('status', 1)->orderBy('sort')->get();
        return view('admin.client.add_client', compact('categories'));
    }

    public function addClient(Request $request)
    {
        $request->validate([
            'category' => 'required|max:100',
            'name' => 'nullable|max:100',
            'web_url' => 'nullable|max:255',
            'image' => 'required|image',
        ]);

        // Handle image upload
        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/uploads/client');
        $file->move($destinationPath, $filename);

        // Thumbs
        $img = Image::make($destinationPath.'/'.$filename);
        $img->resize(230, 200);
        $img->save(storage_path('app/public/uploads/client/thumbs/'.$filename), 50);

        // Create the client entry
        $client = new Client();
        $client->category_id = $request->category;
        $client->name = $request->name;
        $client->web_url = $request->web_url;
        $client->image = $filename;
        $client->save();

        return redirect()->route('all.client')->with('message', 'Customer added successfully.');
    }

    public function editClient(Client $client)
    {
        $categories = CustomerCategory::where('status', 1)->orderBy('sort')->get();
        return view('admin.client.edit_client', compact('client', 'categories'));
    }

    public function updateClient(Client $client, Request $request)
    {
        $request->validate([
            'name' => 'nullable|max:100',
            'web_url' => 'nullable|max:255',
            'category' => 'required|max:100',
            'image' => 'nullable|image',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image files if a new image is uploaded
            if (Storage::exists('public/uploads/client/'.$client->image)) {
                Storage::delete('public/uploads/client/'.$client->image);
                Storage::delete('public/uploads/client/thumbs/'.$client->image);
            }

            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads/client');
            $file->move($destinationPath, $filename);

            // Create thumbnail
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(230, 200);
            $img->save(storage_path('app/public/uploads/client/thumbs/'.$filename), 50);

            $client->image = $filename;
        }

        $client->name = $request->name;
        $client->web_url = $request->web_url;
        $client->category_id = $request->category;
        $client->save();

        return redirect()->route('all.client')->with('message', 'Customer updated successfully.');
    }

    public function deleteClient(Request $request)
    {
        $client = Client::find($request->id);

        // Delete image files
        if ($client) {
            Storage::delete('public/uploads/client/'.$client->image);
            Storage::delete('public/uploads/client/thumbs/'.$client->image);
            $client->delete();
        }

        return redirect()->route('all.client')->with('message', 'Customer deleted successfully.');
    }
}
