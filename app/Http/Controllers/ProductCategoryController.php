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
        return response()->json(
            ["success" => true, ProductCategory::all()],
            201
        );
    }

    public function get($id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(
                [
                    "error" => "No Category Found",
                ],
                401
            );
        }
        return response()->json(
            ["success" => true, "ProductCategory" => $ProductCategory],
            201
        );
    }
    public function update($id, Request $request)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(
                [
                    "error" => "No Product Category Found",
                ],
                401
            );
        }
        $ProductCategory->update($request->all());

        return response()->json(
            ["success" => true, "ProductCategory" => $ProductCategory],
            200
        );
    }

    /**Not used or needed */
    public function delete($id)
    {
        $ProductCategory = ProductCategory::find($id);
        if (!$ProductCategory) {
            return response()->json(
                [
                    "error" => "No Product Category Found",
                ],
                401
            );
        }
        $ProductCategory->delete();
        return response(["success" => true], 200);
    }
}
