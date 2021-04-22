<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Branch;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class BranchController extends BaseController
{
    public function get_all()
    {
        return response()->json(Branch::all());
    }

    public function get($id)
    {
        return response()->json(Branch::find($id));
    }

    public function create(Request $request)
    {
        $Branch = Branch::create($request->all());

        return response()->json($Branch, 201);
    }

    public function update($id, Request $request)
    {
        $Branch = Branch::findOrFail($id);
        $Branch->update($request->all());

        return response()->json($Branch, 200);
    }

    public function delete($id)
    {
        Branch::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}