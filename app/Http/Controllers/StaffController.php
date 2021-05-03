<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class StaffController extends BaseController
{
    public function getAll()
    {
        return response()->json(Staff::all());
    }

    public function get($id)
    {
        return response()->json(Staff::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:30",
            "password" => "required|max:1000",
        ]);
        $Staff = Staff::create([
            "name" => $request->name,
            "password" => Hash::make($request->get("password")),
        ]);
        return response()->json(
            ["status" => "success", "Staff_id" => $Staff->id],
            201
        );
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:30",
            "password" => "required|max:1000",
        ]);
        $Staff = Staff::findOrFail($id);
        $Staff->update($request->all());
        return response()->json(["status" => "success", $Staff], 200);
    }

    public function delete($id)
    {
        Staff::findOrFail($id)->delete();
        return response("Deleted Successfully", 200);
    }
}
