<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductController extends BaseController
{
    public function get_all()
    {
        return response()->json(Product::all());
    }

    public function get($id)
    {
        return response()->json(Product::find($id));
    }

    public function create(Request $request)
    {
        $Product = Product::create($request->all());

        return response()->json($Product, 201);
    }

    public function update($id, Request $request)
    {
        $Product = Product::findOrFail($id);
        $Product->update($request->all());

        return response()->json($Product, 200);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
}