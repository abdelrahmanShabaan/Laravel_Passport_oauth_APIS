<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{


        public function register(Request $request)
        {
                //Here we will make Valdidor and don't forget to  make Facades Vaid up to work successfully
                $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required|email',
                        'password' => 'required',
                        'c_password' => 'required|same:password',
                ]);

                if ($validator->fails()) {
                        // Here i say if any error happen return somtthing error relate with
                        return $this->sendError('error validation', $validator->errors());
                }

                $input = $request->all();
                //here we make bcrypt to input var -> that have value of Request of all data that return 
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                // Here we make success var have -> value of $user var have value of request returnd to make Create
                // Token make users have accessToken  
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['name'] = $user->name;
                //show at the end success messages by created
                return $this->sendResponse($success, 'User created succesfully');

        }
}        
