<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class SupplierController extends BaseController
{
    public function getAll()
    {
        return response()->json(
            [
                Supplier::all(),
            ],
            201
        );
    }

    public function get($id)
    {
        $Supplier = Supplier::find($id);
        if (!$Supplier) {
            return response()->json(
                [
                    "error" => "No Supplier Found",
                ],
                401
            );
        }
        return response()->json(
            [
                "Supplier" => $Supplier,
            ],
            201
        );
    }

  public function create(Request $request)
    {
        $Supplier = Supplier::create($request->all());

        if (!$Supplier) {
            return response()->json(
                [
                    "error" => "Error creating Supplier",
                ],
                401
            );
        }
        return response()->json(
            [
                "supplier" => $Supplier,
            ],
            201
        );
    }

 public function update($id, Request $request)
    {
        $Supplier = Supplier::find($id);
        if (!$Supplier) {
            return response()->json(
                [
                    "error" => "No Supplier Category Found",
                ],
                401
            );
        }
        $Supplier->update($request->all());

        return response()->json(
            [
                "supplier" => $Supplier,
            ],
            200
        );
    }

    public function delete($id)
    {
        $Supplier = Supplier::find($id);
        if (!$Supplier) {
            return response()->json(
                [
                    "error" => "No Supplier Found",
                ],
                401
            );
        }
        $Supplier->delete();
        return response(
            [
                "success" => true,
            ],
            200
        );
    }
}
