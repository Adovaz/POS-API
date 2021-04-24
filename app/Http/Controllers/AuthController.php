<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends BaseController
{
    public function login(Request $request)
    {

     $this->validate($request, [
        'staff_id'     => 'required',
        'password'  => 'required'
    ]);

    // Find the staff by id
    $hashAgainst =  Staff::where('id', $request->staff_id)->value('password');
        if (!$hashAgainst) {
        // You wil probably have some sort of helpers or whatever
        // to make sure that you have the same response format for
        // differents kind of responses. But let's return the 
        // below respose for now.
        return response()->json([
            'error' => 'Staff ID does not exist.'
        ], 400);
    }

    // Verify the password and generate the token
    if (Hash::check($request->password, $hashAgainst)) {
      $token = base64_encode(STR::random(40));
      Staff::where('id', $request->id)
      ->update(['remember_token' => $token]);;
      
      return response()->json(['remember_token' => $token], 200);
    }

    // Bad Request response
    return response()->json([
        'error' => 'staff id or password is wrong.'
    ], 400);
    
    }
}