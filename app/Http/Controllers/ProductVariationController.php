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
        return response()->json([ProductVariation::all()], 201);
    }

    public function get($id)
    {
        $ProductVariations = ProductVariation::where("product_id", $id)->get();
        if (!$ProductVariations) {
            return response()->json(
                [
                    "error" =>
                        "No product Variations With That Parent Id Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "productVariations" => $ProductVariations,
            ],
            201
        );
    }

    public function getByBarcode($barcode)
    {
        $ProductVariation = ProductVariation::where("barcode_0", $barcode)
            ->orWhere("barcode_1", $barcode)
            ->orWhere("barcode_2", $barcode)
            ->get();

        if ($ProductVariation == null) {
            return response()->json(
                [
                    "error" =>
                        "No product Variations With That Parent Id Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "productVariation" => $ProductVariation,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "product_id" => "required",
            "name" => "required",
            "cost" => "required",
            "retail_price" => "required",
        ]);

        $ProductVariation = ProductVariation::create($request->all());

        foreach (Branch::all() as $branches) {
            BranchStock::create([
                "product_variation_id" => $ProductVariation->id,
                "branch_id" => $branches->id,
                "quantity" => 0,
            ]);
        }
        return response()->json(
            [
                "ProductVariation" => $ProductVariation,
            ],
            201
        );
    }

    public function update($id, Request $request)
    {
        $ProductVariation = ProductVariation::findOrFail($id);
        $ProductVariation->update($request->all());

        return response()->json(
            [
                "updated" => $ProductVariation,
            ],
            200
        );
    }

    public function delete($id)
    {
        $ProductVariation = ProductVariation::find($id);
        if (!$ProductVariation) {
            return response()->json(
                [
                    "error" => "No ProductVariation Found",
                ],
                401
            );
        }
        $ProductVariation->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
