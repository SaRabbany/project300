<?php

namespace App\View\Components;

use App\Models\setting as ModelsSetting;
use Illuminate\View\Component;

class setting extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $setting = ModelsSetting::find(1);
        return $setting->price;
    }
}
