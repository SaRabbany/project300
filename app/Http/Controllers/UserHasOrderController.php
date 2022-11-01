<?php

namespace App\Http\Controllers;

use App\Models\userHasOrder;
use App\Http\Requests\StoreuserHasOrderRequest;
use App\Http\Requests\UpdateuserHasOrderRequest;

class UserHasOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreuserHasOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserHasOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userHasOrder  $userHasOrder
     * @return \Illuminate\Http\Response
     */
    public function show(userHasOrder $userHasOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userHasOrder  $userHasOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(userHasOrder $userHasOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserHasOrderRequest  $request
     * @param  \App\Models\userHasOrder  $userHasOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserHasOrderRequest $request, userHasOrder $userHasOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userHasOrder  $userHasOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(userHasOrder $userHasOrder)
    {
        //
    }
}
