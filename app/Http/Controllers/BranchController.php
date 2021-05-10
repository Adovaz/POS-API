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
        return response()->json(
            [
                "success" => true,
                Branch::all(),
            ],
            201
        );
    }

    public function get($id)
    {
        $Branch = Branch::find($id);
        if (!$Branch) {
            return response()->json(
                [
                    "error" => "No Branch Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "success" => true,
                "branch" => $Branch,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
        ]);

        $Branch = Branch::create($request->all());

        foreach (ProductVariation::all() as $productvariation) {
            BranchStock::create([
                "product_variation_id" => $productvariation->id,
                "branch_id" => $Branch->id,
                "quantity" => 0,
            ]);
        }
        return response()->json(
            [
                "success" => true,
                "branch" => $Branch,
            ],
            201
        );
    }

    public function update($id, Request $request)
    {
        $Branch = Branch::find($id);
        if (!$Branch) {
            return response()->json(
                [
                    "error" => "No Branch Found",
                ],
                401
            );
        }

        $Branch->update($request->all());

        return response()->json(
            [
                "success" => true,
                "branch" => $Branch,
            ],
            200
        );
    }

    public function delete($id)
    {
        $Branch = Branch::find($id);

        if (!$Branch) {
            return response()->json(
                [
                    "error" => "No Branch Found",
                ],
                401
            );
        }
        $Branch->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
