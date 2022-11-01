<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userHasChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class authenticationController extends Controller
{
    public function firstRegister(Request $request)
    {

       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed'
       ]);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = 2;
        $user->save();

        $user->reffer_code = $user->id . $this->generateUniqueNumber();
        $user->save();

        if (!is_null($request['reffer_code'])) {
            $fromReffer = User::where('reffer_code', $request['reffer_code'])->first();
            $userHasChildren = new userHasChild;
            $userHasChildren->from_refferd_user_id = $fromReffer->id;
            $userHasChildren->child_user_id = $user->id;
            $userHasChildren->save();
        }

        auth()->login($user);
        return redirect()->route('order');
    }

    public function generateUniqueNumber()
    {
        do {
            $code = random_int(1000, 9999);
        } while (User::where("reffer_code", "=", $code)->first());

        return $code;
    }


    
}
