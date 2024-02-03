<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = \Auth::user()->address()->first();
        return view('profile.address', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request)
    {
        $data = $request->validated();
        $user = \Auth::user();

        if (!empty($user->address()->first())) {
            return response()->json([
                'status' => 'error',
                'message' => 'The user can only have one registered address'
            ],409);
        }

        $userAddress = new UserAddress();
        $userAddress->user_id = $user->id;
        $userAddress->country = $data['country'];
        $userAddress->state = $data['state'];
        $userAddress->city = $data['city'];
        $userAddress->phone = $data['phone'];
        $userAddress->address = $data['address'];
        $userAddress->postal_code = $data['postal_code'];
        $userAddress->details = $data['details'];

        if ($userAddress->save() == true) {
            return response()->json([
                'status' => 'success',
                'message' => 'Address registered successfully'
            ],201);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error registering address, please try again in a few minutes'
        ],500);

    }

    /**
     * Display the specified resource.
     */
    public function show(UserAddress $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $address)
    {
        $address = \Auth::user()->address()->first();

        if ($address->update($request->validated())) {
            return response()->json([
                'status' => 'success',
                'message' => 'Address updated successfully'
            ],200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error updating address, please try again in a few minutes'
        ],500);

        dd($request->validated(),$address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $address)
    {
        $address = \Auth::user()->address()->first();

        if ($address->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Address deleted successfully'
            ],200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error deleting address, please try again in a few minutes'
        ],500);
    }
}
