<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\BranchStock;
use App\Models\Branch;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductVariationController extends BaseController
{
    public function get_all()
    {
        return response()->json(ProductVariation::all());
    }

    public function get($product_id)
    {
        return response()->json(ProductVariation::where('product_id', '=', $product_id));
    }

    public function create(Request $request)
    {
        $ProductVariation = ProductVariation::create($request->all());
        
        foreach (Branch::all() as $branches) 
        {
        $BranchStock = new BranchStock();
        $BranchStock->product_variation_id = $request->id;
        $BranchStock->branch_id = $branches;
        $BranchStock->quantity = 0;
        };

        return response()->json($ProductVariation, 201);
    }

    public function update($id, Request $request)
    {
        $ProductVariation = ProductVariation::findOrFail($id);
        $ProductVariation->update($request->all());

        return response()->json($ProductVariation, 200);
    }

    public function delete($id)
    {
        ProductVariation::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}