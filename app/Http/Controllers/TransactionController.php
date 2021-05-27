<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Sale;
use App\Models\BranchStock;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class TransactionController extends BaseController
{
    public function getAll()
    {
        return response()->json([Transaction::all()], 201);
    }

    public function get($id)
    {
        $Transaction = Transaction::find($id);
        if (!$Transaction) {
            return response()->json(
                [
                    "error" => "No Transaction Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "Transaction" => $Transaction,
            ],
            201
        );
    }

    public function create(Request $request)
    {
        $Transaction = Transaction::create([
            "staff_id" => $request->header("staff_id"),
            "total" => $request->total,
            "transaction_type" => $request->transaction_type,
        ]);

        foreach ($request->contents as $products) {
            Sale::create([
                "transaction_id" => $Transaction->id,
                "product_variation_id" => $products["product_variation_id"],
                "quantity" => $products["quantity"],
            ]);

            BranchStock::where(
                "product_variation_id",
                $products["product_variation_id"]
            )
                ->where("branch_id", $request->header("branchId"))
                ->decrement("quantity", $products["quantity"]);
        }

        return response()->json(
            [
                "Transaction" => $Transaction,
            ],
            201
        );
    }

    public function delete($id)
    {
        $Transaction = Transaction::find($id);
        if (!$Transaction) {
            return response()->json(
                [
                    "error" => "No Transaction Found",
                ],
                401
            );
        }
        $Transaction->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
