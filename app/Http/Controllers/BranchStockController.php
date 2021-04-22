<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BranchStock;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductCategoryController extends BaseController
{
    public function get_all()
    {
        return response()->json(BranchStock::all());
    }

    public function get($id)
    {
        return response()->json(BranchStock::find($id));
    }

    public function create(Request $request)
    {
        $BranchStock = BranchStock::create($request->all());
        return response()->json($BranchStock, 201);
    }

    public function update($id, Request $request)
    {
        $BranchStock = BranchStock::findOrFail($id);
        $BranchStock->update($request->all());

        return response()->json($BranchStock, 200);
    }

    public function delete($id)
    {
        BranchStock::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}