<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\BranchStock;
use App\Models\Branch;
use App\Models\Product;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductVariationController extends BaseController
{
    public function getAll()
    {
        return response()->json(ProductVariation::all());
    }

    public function get($id)
    {
        $ProductVariations = ProductVariation::where('product_id', $id)->get();
        return response()->json($ProductVariations);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'name'  => 'required',
            'cost'  => 'required',
            'retail_price'  => 'required'
        ]);

        $ProductVariation = ProductVariation::create($request->all());

        foreach (Branch::all() as $branches) 
        {
        BranchStock::create([
            'product_variation_id' => $ProductVariation->id,
            'branch_id' => $branches->id,
            'quantity' => 0,
        ]);
        };
        return response()->json($ProductVariation, 201);
    }

    public function update($id, Request $request)
    {
        $ProductVariation = ProductVariation::findOrFail($id);
        $ProductVariation->update($request->all());

        return response()->json(['status' => 'success', 'updated' => $ProductVariation], 200);
    }

    public function delete($id)
    {
        if(ProductVariation::findOrFail($id)->delete()){
            return response(['status' => 'success'], 200);
        }
        else{

        return response(['status' => 'fail'], 400);

        };
    }
    
}