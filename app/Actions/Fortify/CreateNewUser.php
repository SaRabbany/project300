<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\userHasChild;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();


        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->role_id = 2;
        $user->save();

        $user->reffer_code = $user->id . $this->generateUniqueNumber();
        $user->save();

        if(!is_null($input['reffer_code'])){
            $fromReffer = User::where('reffer_code', $input['reffer_code'])->first();
            $userHasChildren = new userHasChild;
            if(!$fromReffer){
                $userHasChildren->from_refferd_user_id = 2;
            }else{
                $userHasChildren->from_refferd_user_id = $fromReffer->id;
            }
            $userHasChildren->child_user_id = $user->id;
            $userHasChildren->save();
        }

        return $user;

    }
    public function generateUniqueNumber()
    {
        do {
            $code = random_int(100000, 999999);
        } while (User::where("reffer_code", "=", $code)->first());

        return $code;
    }

}
