<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function check_username(Request $request)
    {
        $check_user = User::where('username', $request->username)->first();
        if($check_user == true){
            return 'already_taken';
        }else{
            return 'available';
        }
    }
}
