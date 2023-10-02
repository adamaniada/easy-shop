<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart =  Cart::join('products', 'products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->select('carts.id', 'carts.quantity', 'products.title', 'products.description', 'products.unit_price', 'carts.created_at')
                    ->get();

        return response()->json(['cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        return response()->json(['message' => 'Ajouté au panier avec success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::findOrFail($id)->delete();

        return response()->json(['message' => 'Supprimé avec success']);
    }

    public function clearAll()
    {
        Cart::where('carts.user_id', Auth::user()->id)->delete();

        return response()->json(['message' => 'Panier supprimé avec success']);
    }
}
