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
        return response()->json(Supplier::all());
    }

    public function get($id)
    {
        return response()->json(Supplier::find($id));
    }

    public function create(Request $request)
    {
        $supplier = Supplier::create($request->all());

        return response()->json($supplier, 201);
    }

    public function update($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return response()->json($supplier, 200);
    }

    public function delete($id)
    {
        Supplier::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}