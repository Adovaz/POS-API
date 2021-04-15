<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Laravel\Lumen\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    public function getAllProducts()
    {
        return response()->json(Product::all());
    }

    public function getProduct($id)
    {
        return response()->json(Product::find($id));
    }

    public function create(Request $request)
    {
        $author = Product::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Product::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
