<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class StaffController extends BaseController
{
    public function authenticate(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'password' => 'required'
         ]);
         $staff = Staff::where('name', $request->input('name'))->first();
         if(Hash::check($request->input('password'), $staff->password))
         {
           $remember_token = base64_encode(str_random(40));
           Staff::where('id', $request->input('id'))->update(['remember_token' => "$remember_token"]);;
           return response()->json(['status' => 'success','rmemeber_token' => $remember_token]);
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