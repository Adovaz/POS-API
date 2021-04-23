<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends BaseController
{
    public function authenticate(Request $request)
    {
        $staff_id = $request->staff_id;
         if($request->password == Staff::where('id', $staff_id)->value('password'))
         {
           $remember_token = base64_encode(Str::random(40));
           $Staff = Staff::findOrFail($staff_id);
           $Staff->update(['remember_token' => "blahh"]);;
           return response()->json(['status' => 'success','rememeber_token' => $remember_token]);
         }
         else
         {
           return response()->json(['status' => 'fail'],401);
         }
}

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