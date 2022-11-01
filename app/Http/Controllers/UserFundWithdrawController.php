<?php

namespace App\Http\Controllers;

use App\Models\userFundWithdraw;
use App\Http\Requests\StoreuserFundWithdrawRequest;
use App\Http\Requests\UpdateuserFundWithdrawRequest;
use App\Models\order;
use Illuminate\Http\Request;

class UserFundWithdrawController extends Controller
{



    public function withdrawRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50',
            'method' => 'required',
            'account_number' => 'required',
            'user_id' => 'required',

        ]);

        $total_amount = order::where('user_id', $request->user_id)->where('status', 'approved')->sum('price');
        $total_amount_affiliator = (20/100) * $total_amount;

        if($total_amount_affiliator == $request->amount){
            $withdraw = new userFundWithdraw;
            $withdraw->amount = $request->amount;
            $withdraw->method = $request->method;
            $withdraw->account_number = $request->account_number;
            $withdraw->user_id = $request->user_id;
            $withdraw->save();
            return redirect()->back()->with('success', 'Your request has been sent');
        }else{
            return redirect()->back()->with('success', 'You can not withdraw this amount');
        }

    }  // end of withdrawRequest


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
     * @param  \App\Http\Requests\StoreuserFundWithdrawRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserFundWithdrawRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userFundWithdraw  $userFundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function show(userFundWithdraw $userFundWithdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userFundWithdraw  $userFundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(userFundWithdraw $userFundWithdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserFundWithdrawRequest  $request
     * @param  \App\Models\userFundWithdraw  $userFundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserFundWithdrawRequest $request, userFundWithdraw $userFundWithdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userFundWithdraw  $userFundWithdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(userFundWithdraw $userFundWithdraw)
    {
        //
    }
}
