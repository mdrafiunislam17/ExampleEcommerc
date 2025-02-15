<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipment;  // Correct namespace
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    public function index()
    {
        // Paginate the equipment list, 15 items per page
        $equipments = Equipment::orderBy('id', 'asc')->paginate(15);

        return view('admin.equipment.all', compact('equipments'));
    }

    public function add()
    {
        return view('admin.equipment.add');
    }

    public function addPost(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|max:255',
            'capacity' => 'nullable|max:255',
            'quantity' => 'nullable|max:255',
            'remark' => 'nullable|max:255',
        ]);

        // Create a new equipment record
        $equipment = new Equipment();
        $equipment->name = $request->name;
        $equipment->capacity = $request->capacity;
        $equipment->quantity = $request->quantity;
        $equipment->remark = $request->remark;
        $equipment->save();

        // Redirect back with success message
        return redirect()->route('admin_all_equipment')->with('message', 'Equipment & Tools added successfully.');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function editPost(Equipment $equipment, Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|max:255',
            'capacity' => 'nullable|max:255',
            'quantity' => 'nullable|max:255',
            'remark' => 'nullable|max:255',
        ]);

        // Update the equipment record
        $equipment->name = $request->name;
        $equipment->capacity = $request->capacity;
        $equipment->quantity = $request->quantity;
        $equipment->remark = $request->remark;
        $equipment->save();

        // Redirect back with success message
        return redirect()->route('admin_all_equipment')->with('message', 'Equipment & Tools updated successfully.');
    }

    public function delete(Request $request)
    {
        // Find the equipment record
        $equipment = Equipment::find($request->id);
        // Delete the equipment record
        $equipment->delete();

        // Optionally, you can delete the associated image if it exists:
        // unlink(public_path('uploads/equipment/'.$equipment->image));
    }
}
