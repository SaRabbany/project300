<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Models\User;
use App\Models\userHasChild;
use App\Models\userHasOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
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


    public function orderProduct()
    {
       // future plan calculate who is clicked on order page
        return view('home.order');
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
     * @param  \App\Http\Requests\StoreorderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreorderRequest $request)
    {
        $order = new order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->price = $request->price;
        $order->phone = $request->phone;
        $order->user_id = auth()->user()->id;

        $order->date = $request->date;
        $order->quantity = $request->quantity;
        $order->starting_point = $request->starting_point;
        $order->destination = $request->destination;

        $order->save();


        return back()->withSuccess('orderSuccess');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorderRequest  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateorderRequest $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function orderUnsuccessfull()
    {
        return view('orderUnsuccessfull');
    }

    public function cryptosuccess(Request $request)
    {
        return view('orderSuccess');
    }

    public function ordersuccessfull(Request $request)
    {
        return view('orderSuccess');
    }



}
