<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\ProductVariation;
use App\Models\BranchStock;
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
        foreach (ProductVariation::all() as $productvariation) 
        {
        $BranchStock = BranchStock::create([
            'product_variation_id' => $productvariation->id,
            'branch_id' => $Branch->id,
            'quantity' => 0,
        ]);
        }
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