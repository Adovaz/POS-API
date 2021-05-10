<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class ProductController extends BaseController
{
    public function getAll()
    {
        return response()->json(
            [
                "success" => true,
                Product::all(),
            ],
            201
        );
    }

    public function get($id)
    {
        $Product = Product::find($id);
        if (!$Product) {
            return response()->json(
                [
                    "error" => "No Product Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "success" => true,
                "Product" => $Product,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $Product = Product::create($request->all());

        if (!$Product) {
            return response()->json(
                [
                    "error" => "Error creating product",
                ],
                401
            );
        }

        return response()->json(
            [
                "success" => true,
                "product" => $Product,
            ],
            201
        );
    }

    public function update($id, Request $request)
    {
        $Product = Product::find($id);
        if (!$Product) {
            return response()->json(
                [
                    "error" => "No Product Found",
                ],
                401
            );
        }
        $Product->update($request->all());

        return response()->json(
            [
                "success" => true,
                "Product" => $Product,
            ],
            200
        );
    }

    public function delete($id)
    {
        $Product = Product::find($id);
        if (!$Product) {
            return response()->json(
                [
                    "error" => "No Product Found",
                ],
                401
            );
        }
        $Product->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
