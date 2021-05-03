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
    $Staff = Staff::find($request->staff_id);
        if (!$Staff) {
        return response()->json([
            'error' => 'Staff ID does not exist.'
        ], 401);
    }
    // Verify the password and generate the token
    if (Hash::check($request->password, $Staff->password)) {
      $token = base64_encode(STR::random(40));
      $Staff->remember_token = $token;
      $Staff->save();
      return response()->json(['remember_token' => $token], 200);
    }

    // Bad Request response
    return response()->json([
        'error' => 'Staff ID or password is wrong.'
    ], 401);
    
    }
}