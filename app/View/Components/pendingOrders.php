<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class pendingOrders extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $pending_orders;
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      
        $pending_orders = DB::table('orders')->where('status', 'pending')->count();
        return view('components.pending-orders', compact('pending_orders'));
    }
}
