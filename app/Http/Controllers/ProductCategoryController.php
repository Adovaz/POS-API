<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductCategoryController extends BaseController
{
    public function getAll()
    {
        return response()->json([ProductCategory::all()], 201);
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
            [
                "productCategory" => $ProductCategory,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $ProductCategory = ProductCategory::create($request->all());

        if (!$ProductCategory) {
            return response()->json(
                [
                    "error" => "Error creating Product Category",
                ],
                401
            );
        }
        return response()->json(
            [
                "productCategory" => $ProductCategory,
            ],
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
            [
                "ProductCategory" => $ProductCategory,
            ],
            200
        );
    }

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
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
