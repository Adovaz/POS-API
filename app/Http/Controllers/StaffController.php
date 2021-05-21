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
        return response()->json(
            [
                "staff" => Staff::all(),
            ],
            201
        );
    }

    public function get($id)
    {
        $Staff = Staff::find($id);
        if (!$Staff) {
            return response()->json(
                [
                    "error" => "No Staff Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "Staff" => $Staff,
            ],
            201
        );
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
            [
                "Staff_id" => $Staff->id,
            ],
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
        return response()->json(
            [
                "staff" => $Staff,
            ],
            200
        );
    }

    public function delete($id)
    {
        $Staff = Staff::find($id);
        if (!$Staff) {
            return response()->json(
                [
                    "error" => "No Staff Found",
                ],
                401
            );
        }
        $Staff->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
