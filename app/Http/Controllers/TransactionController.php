<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Sale;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class TransactionController extends BaseController
{
    public function get_all()
    {
        return response()->json(Transaction::all());
    }

    public function get($id)
    {
        return response()->json(Transaction::find($id));
    }

    public function create(Request $request)
    {
        $Transaction = Transaction::create
        ([
            'staff_id' => $request->staff_id,
            'total' => $request->total,
            'transaction_type' => $request->transaction_type,
        ]);
        foreach ($request->contents as $products)
        {
            Sale::create
            ([
                'transaction_id' => $Transaction->id,
                'product_variation_id' => $products['product_variation_id'],
                'quantity' => $products['quantity'],
            ]);
        }

        return response()->json($Transaction, 201);
    }

    public function update($id, Request $request)
    {
        $Transaction = Transaction::findOrFail($id);
        $Transaction->update($request->all());

        return response()->json($Transaction, 200);
    }

    public function delete($id)
    {
        Transaction::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}