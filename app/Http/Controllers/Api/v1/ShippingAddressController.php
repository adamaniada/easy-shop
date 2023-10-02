<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShippingAddressController extends Controller
{
    public function index()
    {
        $shippingAddress = ShippingAddress::find(auth()->id());
        if (!$shippingAddress) {
            return response()->json(['message' => 'Shipping address not found'], 404);
        }
        return response()->json(['shipping_address' => $shippingAddress]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|in:en cours,livré',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $shippingAddress = new ShippingAddress();
        $shippingAddress->user_id = Auth::user()->id;
        $shippingAddress->address = $request->input('address');
        $shippingAddress->city = $request->input('city');
        $shippingAddress->postal_code = $request->input('postal_code');
        $shippingAddress->country = $request->input('country');
        $shippingAddress->state = $request->input('state');
        $shippingAddress->save();

        return response()->json(['shipping_address' => $shippingAddress], 201);
    }

    public function update(Request $request, $id)
    {
        // Les mises à jour pourraient ne pas être nécessaires, car les adresses de livraison sont généralement créées et supprimées, pas mises à jour.
    }

    public function destroy(string $id)
    {
        ShippingAddress::findOrFail($id)->delete();

        return response()->json(['message' => 'Supprimé avec success']);
    }
}
