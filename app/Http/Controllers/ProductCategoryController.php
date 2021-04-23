<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductCategoryController extends BaseController
{
    public function getAll()
    {
        return response()->json(ProductCategory::all());
    }

    public function get($id)
    {
        return response()->json(ProductCategory::find($id));
    }

    public function create(Request $request)
    {
        $ProductCategory = ProductCategory::create($request->all());
        return response()->json($ProductCategory, 201);
    }

    public function update($id, Request $request)
    {
        $ProductCategory = ProductCategory::findOrFail($id);
        $ProductCategory->update($request->all());

        return response()->json($ProductCategory, 200);
    }

    public function delete($id)
    {
        ProductCategory::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}