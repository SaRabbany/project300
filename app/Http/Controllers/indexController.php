<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\setting;
use App\Models\User;
use App\Models\userHasChild;
use App\Models\userWorkAnalysis;
use Illuminate\Http\Request;

class indexController extends Controller
{






    public function index()
    {
        $allOrders = order::where('affiliator_user_id', auth()->user()->id)->get();
        $workAnalysis = array();


        $pendingOrders =  $allOrders->where('status', 'pending')->count();
        $approvedOrders =  $allOrders->where('status', 'approved')->count();
        $rejectedOrders =  $allOrders->where('status', 'rejected')->count();
        $allOrders = $allOrders->count();



        //clicks

        $works = userWorkAnalysis::where('user_id', auth()->user()->id)->first();
        $clicks = 0;
        if($works){
            $clicks = $works->total_clicks;
        }else{
            $clicks = 0;
        }


        // total income

        $totalOrders = order::where('affiliator_user_id', auth()->user()->id)->where('status', 'approved')->get();
        $totalIncome = 0;
        foreach ($totalOrders as $totalOrder) {
            $totalIncome += $totalOrder->price;
        }

        if($totalIncome > 0){
            $prtcentage = (20 / 100) * $totalIncome;
        }else{
            $prtcentage = 0;
        }

        // merging all data to one array

        $workAnalysis['pendingOrders'] = $pendingOrders;
        $workAnalysis['approvedOrders'] = $approvedOrders;
        $workAnalysis['rejectedOrders'] = $rejectedOrders;
        $workAnalysis['allOrders'] = $allOrders;
        $workAnalysis['clicks'] = $clicks;
        $workAnalysis['totalIncome'] = $prtcentage;


        $buyer_orders = order::where('user_id', auth()->user()->id)->get();



        return view('deshboard', compact('workAnalysis','buyer_orders'));
    }

    public function user($refferCode = null)
    {
        if(!is_null($refferCode)){

            $reffered_user = User::where('reffer_code', $refferCode)->first();
            if($reffered_user){
               $userWork = userWorkAnalysis::where('user_id', $reffered_user->id)->first();
                if(!$userWork){
                     $userWork = new userWorkAnalysis;
                     $userWork->user_id = $reffered_user->id;
                     $userWork->total_clicks = 0;
                     $userWork->total_orders = 0;
                     $userWork->save();
                }else{
                    $userWork->total_clicks = $userWork->total_clicks + 1;
                    $userWork->save();
                }
            }else{
                $refferCode = null;
            }



        }
        $setting = setting::find(1);


        return view('home', compact('refferCode','setting'));
    }

    public function affiliatorSwitch(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

      $user = User::find($request->user_id);
      $user->affiliate_status =  $user->affiliate_status == 0 ? 1 : 0;
      $user->save();

      return redirect()->back();
    }

    public function pendingOrderCount()
    {
        $pendingOrders =  order::where('status', 'pending')->count();
        return response()->json(['pendingOrders' => $pendingOrders]);
    }
}
