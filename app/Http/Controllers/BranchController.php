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
    public function getAll()
    {
        return response()->json(Branch::all());
    }

    public function get($id)
    {
        $branch = Branch::find($id);
        if (!$branch){
            return response()->json(
                ['error' => 'No Branch Found'],
                 401);
        };
        return response()->json();
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required'
        ]);

        /**Create Branch */
        $Branch = Branch::create($request->all());

        /**Update Branch Stocks */
        foreach (ProductVariation::all() as $productvariation) 
        {
        BranchStock::create([
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