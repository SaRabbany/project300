<?php

namespace App\Http\Controllers;

use App\Models\superAdmin;
use App\Models\order;
use App\Models\User;
use App\Models\userFundWithdraw;
use App\Models\userHasChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = order::orderBy('id', 'desc')->get();
        return view('admin.dashboard',[
            'orders' => $orders,
        ]);
    }


    public function pendingOrders()
    {
        $pendingOrders = order::where('accepted', false)->orderBy('id','DESC')->get();
        return view('admin.orders.pendingOrder', compact('pendingOrders'));
    }

    public function allOrders()
    {
        $allOrders = order::where('accepted', true)->orderBy('id','DESC')->get();

        return view('admin.orders.allOrders', compact('allOrders'));
    }

    public function declinedOrders()
    {
        $allOrders = order::where('status', 'declined')->orderBy('id','DESC')->get();
        if($allOrders->count() > 0){
            foreach($allOrders as $singleorder){
                $affiliator_user_id =  userHasChild::where('child_user_id', $singleorder->user_id)->first();
                if($affiliator_user_id){
                    $affiliator = User::find($affiliator_user_id->from_refferd_user_id);
                }else{
                    $affiliator = User::find(2);
                }

               $singleorder['affiliator'] = $affiliator;
            }
        }
        return view('admin.orders.allOrders', compact('allOrders'));
    }


    public function approve(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        $order = order::find($request->order_id);
        $order->accepted = true;
        $order->save();
        return redirect()->back()->with('success', 'Order Approved Successfully');
    }

    public function decline(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        $order = order::find($request->order_id);
        $order->status = 'declined';
        $order->save();
        return redirect()->back()->with('success', 'Order Declined Successfully');
    }





   public function destroyOrder(Request $request)
   {
        $request->validate([
            'order_id' => 'required',
        ]);

        order::find($request->order_id)->delete();
        return redirect()->back()->with('success', 'Order Deleted Successfully');

   }

   public function affiliatorIncome()
   {
        $affilators = User::where('id','!=', 1)->paginate(10);
        if($affilators->count() > 0){
            foreach($affilators as $affilator){

               $affiliator_orders = order::where('affiliator_user_id', $affilator->id)->where('status', 'approved')->get();
                $total_income = 0;
                $total_orders = 0;
                $prev_total_income = 0;
                if($affiliator_orders->count() > 0){
                    $total_orders = $affiliator_orders->count();
                    foreach($affiliator_orders as $order){
                        $prev_total_income += $order->price;
                    }
                    $total_income = (20/100) * $prev_total_income;
                }

               $affilator['income'] = $total_income;
               $affilator['orders'] = $total_orders;
            }
        }

        return view('affiliator.income', compact('affilators'));
   }

   public function affiliatorPaymentRequest()
   {
       $requests = userFundWithdraw::with('user')->where('status', 'pending')->get();
       return view('admin.paymentRequest', compact('requests'));
   }


   public function affiliatorPaymentRequestApprove(Request $request)
   {
        $request->validate([
            'request_id' => 'required',
        ]);

        $request = userFundWithdraw::find($request->request_id);
        $request->status = 'approved';
        $request->save();
        return redirect()->back()->with('success', 'Payment Request Approved Successfully');
   }


   public function affiliatorPaymentRequestRejct(Request $request)
   {
        $request->validate([
            'request_id' => 'required',
        ]);

        $request = userFundWithdraw::find($request->request_id);
        $request->status = 'rejected';
        $request->save();
        return redirect()->back()->with('success', 'Payment Request Approved Successfully');
   }



}
