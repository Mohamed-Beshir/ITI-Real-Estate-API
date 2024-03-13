<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//  require_once(__DIR__.'/Controller.php');
use App\Http\Requests\CreateUserRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // return view('users.index', ['users' => $users]);
        return $users;
    }
    public function show(user $user)
    {
        return $user;
    }


    // public function store(Request $request)
    // {
    //     // User::create($request->all());
    //     $Validator  = Validator::make($request->all(), [

    //         "name" => "required|min:3|:Users",
    //         "email" => "required|email",
    //         "password" => "required|min:8",
    //          "role"=>"required",
    //         "confirmpassword" => "required|min:8"
    //     ]);
    //     if ($Validator->fails()) {
    //         return response($Validator->errors()->all());
    //     }
    //     $user = User::create($request->all());

    //     return response($user, 201);
    // }

    public function update(Request $request, user $user )
    {
        $Validator = Validator::make($request->all(), [

            "name" => "required|min:3|:Users",
            // "email" => [Rule::unique('users')->ignore($user->id)],
            "email" => "required|email",
             "role"=>"required",
             "password" => "required|min:8",
            "confirmpassword" => "required|min:8"

        ]);
        if ($Validator->fails()) {
            return response($Validator->errors()->all());
        }

         $user->update($request->all());

        return response($user, 201);

    }



    public function destroy(user $user)
    {

        $user->delete();
        return response('User deleted successfully.', 204);

        // return  'User deleted successfully.';

   }
}