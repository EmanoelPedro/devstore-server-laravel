<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPaymentStatusRequest;
use App\Http\Requests\UpdateUserPaymentStatusRequest;
use App\Models\UserPaymentStatus;

class UserPaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreUserPaymentStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPaymentStatus $userPaymentStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPaymentStatus $userPaymentStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPaymentStatusRequest $request, UserPaymentStatus $userPaymentStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPaymentStatus $userPaymentStatus)
    {
        //
    }
}
