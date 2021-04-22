<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class StaffController extends BaseController
{
    public function get_all()
    {
        return response()->json(Staff::all());
    }

    public function get($id)
    {
        return response()->json(Staff::find($id));
    }

    public function create(Request $request)
    {
        $Staff = Staff::create($request->all());
        return response()->json($Staff, 201);
    }

    public function update($id, Request $request)
    {
        $Staff = Staff::findOrFail($id);
        $Staff->update($request->all());

        return response()->json($Staff, 200);
    }

    public function delete($id)
    {
        Staff::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}