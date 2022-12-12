<?php

namespace App\Http\Controllers\loginsystem;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
   

    public function register(loginRequest $request)
    {
        
        try {
            $createUsers = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
          

   
                
        
        } catch (\Throwable $th) {
            //throw $th;
            return $this->badRequestResponse("Error", ['errror' => $th->getMessage()]);
        }
        return $this->successResponse('sucessfuly created', $createUsers);
    }
   

    public function login(Request $request)
    {

        $fields = $request->validate([

            'email' => 'required|string|email',
            'password' => 'required|string',

        ]);
        try {

                $user = User::where('email', $fields['email'])->first();
            
             if (!$user || !Hash::check($fields['password'], $user->password)) {
            
                      return $this->badRequestResponse("Wrong Credentials");
                  }
            
              } catch (\Exception $e) {
            
                   return $this->badRequestResponse($e->getMessage());
                }
            
            
                return $this->successResponse("User logged in", $user);
    }
   
    
   
   
}

// class loginsystem extends Controller
// {
    
//     public function register(loginRequest $Request)
//     {
//         try {
//             $createUsers = User::create([
//                 'firstname' => $request->firstname,
//                 'lastname' => $request->lastname,
//                 'email' => $request->email,
//                 'password' => Hash::make($request->password),
//             ]);
            
//          } catch (\Throwable $th) {
//             //throw $th;
//             return $this->badRequestResponse("Error", ['errror' => $th->getMessage()]);
//          }
//          return $this->successResponse('sucessfuly created', $createUsers);
//         }
 
//     }
// }

// public function login(Request $request)
// {

//     $fields = $request->validate([

//         'email' => 'required|string|email',
//         'password' => 'required|string',

//     ]);
//     try {

//         $user = User::where('email', $fields['email'])->first();

//         if (!$user || !Hash::check($fields['password'], $user->password)) {

//             return $this->badRequestResponse("Wrong Credentials");
//         }

//     } catch (\Exception $e) {s

//         return $this->badRequestResponse($e->getMessage());
//     }


//     return $this->successResponse("User logged in", $response);
// }
