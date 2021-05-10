<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BranchStock;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class BranchStockController extends BaseController
{
    public function getAll()
    {
        return response()->json(
            [
                "success" => true,
                BranchStock::all(),
            ],
            201
        );
    }

    public function get($id)
    {
        $BranchStock = BranchStock::find($id);
        if (!$BranchStock) {
            return response()->json(
                [
                    "error" => "No Branch Stock Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "success" => true,
                "stock" => $BranchStock,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $BranchStock = BranchStock::create($request->all());

        if (!$BranchStock) {
            return response()->json(
                [
                    "error" => "Error creating branch stock",
                ],
                401
            );
        }
        return response()->json(
            [
                "success" => true,
                "stock" => $BranchStock,
            ],
            201
        );
    }

    public function update($id, Request $request)
    {
        $BranchStock = BranchStock::find($id);

        if (!$BranchStock) {
            return response()->json(
                [
                    "error" => "No BranchStock Found",
                ],
                401
            );
        }
        $BranchStock->update($request->all());

        return response()->json(
            [
                "success" => true,
                "stock" => $BranchStock,
            ],
            200
        );
    }

    /**Not used or needed */
    public function delete($id)
    {
        $BranchStock = BranchStock::find($id);
        if (!$BranchStock) {
            return response()->json(
                [
                    "error" => "No BranchStock Found",
                ],
                401
            );
        }
        $BranchStock->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
