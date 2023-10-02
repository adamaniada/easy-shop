<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['transactions' => $transactions]);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return response()->json(['transaction' => $transaction]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:ads,id',
            'amount' => 'required|numeric',
            'quantity' => 'required|integer',
            'state' => 'required|in:en cours,terminé,annulée,etc',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $transaction = new Transaction();
        $transaction->customer_id = $request->input('customer_id');
        $transaction->product_id = $request->input('product_id');
        $transaction->amount = $request->input('amount');
        $transaction->quantity = $request->input('quantity');
        $transaction->state = $request->input('state');
        $transaction->save();

        return response()->json(['transaction' => $transaction], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:users,id',
            'product_id' => 'exists:ads,id',
            'amount' => 'numeric',
            'quantity' => 'integer',
            'state' => 'in:en cours,terminé,annulée,etc',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($request->has('customer_id')) {
            $transaction->customer_id = $request->input('customer_id');
        }
        if ($request->has('product_id')) {
            $transaction->product_id = $request->input('product_id');
        }
        if ($request->has('amount')) {
            $transaction->amount = $request->input('amount');
        }
        if ($request->has('quantity')) {
            $transaction->quantity = $request->input('quantity');
        }
        if ($request->has('state')) {
            $transaction->state = $request->input('state');
        }

        $transaction->save();

        return response()->json(['transaction' => $transaction]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted']);
    }
}
