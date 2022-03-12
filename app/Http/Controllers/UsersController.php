<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Country;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    function getUsers($active = 1, $countryName = 'Austria'){
        $country = Country::where('name', $countryName)->first();
        if(!$country){
            throw new Exception("Country with name `{$countryName}` not found.", 1);
        }
        $users = User::select('users.*')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('countries','user_details.citizenship_country_id','=','countries.id')
                    ->where('countries.name', '=', $countryName)
                    ->where('users.active', '=', $active)
                    ->get();
        return $users;
    }

    function setUser(Request $request, $id){
        try{
            $user = User::findOrFail($id);
        } catch(ModelNotFoundException){
            throw new Exception("User with id `{$id}` not found.", 1);
        }

        $userDetails = UserDetail::where('user_id', $user->id)->first();
        if(!$userDetails){
            throw new Exception("User details with user id `{$id}` not found.", 1);
        }

        $country = Country::where('name', $countryName)->first();
        if(!$country){
            throw new Exception("Country with name `{$countryName}` not found.", 1);
        } 

        $userDetails->last_name = $request->input('last_name');
        $userDetails->first_name = $request->input('first_name');
        $userDetails->phone_number = $request->input('phone_number');
        $userDetails->citizenship_country_id = $country->id;

        $userDetails->save();
        return 'User updated.';
    }

    function deleteUser($id){
        $userDetails = UserDetail::where('user_id', $id)->first();
        if($userDetails){
            throw new Exception("Unable to delete user with id `{$id}` because it has user details.", 1);
        } 
        $user = User::findOrFail($id)->delete();    
        return "User with id {$id} deleted.";
    }
}
