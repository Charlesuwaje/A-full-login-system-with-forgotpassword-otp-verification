<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\passwordResetRequest;
use App\Mail\SendCodeResetPassword;
use App\Models\User;
use App\Models\ResetCodePassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

public function register(Request $request){

$request->validate([
     'firstname'=>'required|string',
		 'lastname'=>'required|string',
		 'email'=> 'required|string|unique:users',
		 'password'=>'required|string|min:6',

]);
$user =new user([
   'firstname'=> $request->firstname,
	 'lastname'=> $request->lastname,
	 'email'=> $request->email,
	 'password'=>Hash::make($request->password)

]);
$user->save();
$token = rand(000,999);
return response()->json(['message'=>'user has been registerd',$user,$token],200);
// return $this->successResponse('sucessfuly created', $user);
}
public function login(Request $request){
	
	$request->validate([
		'email'=>['required','exists:users,email'],
		'password'=>'required|string|min:6'
	]);
   $users = User::where('email',$request->email)->first();
	//  if(!$users || $users->email_verified_at=="") return "email not verified"; 

	 if(!$users) return " do not exsit";
if (!Hash::check($request->password,$users->password)) {
  throw ValidationException::withMessages(["message"=>"Wrong details 😢"]);
}
return response()->json(['message'=>'successful login 😊'],200);


$user= $request->user();
$tokenResult= $user->createtoken('personal access token');
$token=$tokenResult->token;
$token->expires_at=Carbon::now()->addweeks(1);

$token->save();
return response()->json(['data'=>[
   'user'=>Auth::user(),
	 'access_token'=>$tokenResult->accesstoken,
	 'token_type'=>'Bearer',
	 'expires_at'=>Carbon::parse($tokenResult->token->expire_at)->toDateTimeString()
	 
]]);

}
public function PasswordResetOpt(Request $request)
{
	if (empty($request->token)) return $this->badRequestResponse("Error");
	$check = user::where('token', $request->token)->first();
	if (is_Null($check)) return $this->badRequestResponse('Error invalid token');
	return $this->successResponse("done", $check);
}
public function forgetPassword(Request $request)
{
	$data = $request->validate([
		'email' => 'required|email|exists:users',
	]);

	// Delete all old code that user send before.
	ResetCodePassword::where('email', $request->email)->delete();

	// Generate random code
	$data['code'] = rand(000,999);

	// Create a new code
	$codeData = ResetCodePassword::create($data);

	// Send email to user
	Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
	
	return response(['message' => trans('passwords.sent')], 200);
}




// public function forgetPassword(PasswordResetRequest $request)
//     {
//         $attributes = $request->all();
//         $user = User::where('email', $attributes['email'])->first();
//         if (!$user) {
//             return $this->badRequestResponse('This user is not found');
//         }
//         $user->fill([
//             'password' => hash::make($attributes['password'])
//         ]);
//         $user->save();
//         $user->tokens()->delete();
//         return $this->successResponse("Password reset successful", $user);
//     }




// public function forgot (){
// $credentials= request()->validate(['email'=>'required|email']);
// password::sensResetlink($credentials);
// return$this->respondwithmessage(msg:"reset  password link sent to your email");


// }
// public function reset(passwordResetRequest $request){
// 	$credentials=  request()->validate([
// 'email'=>'required|email',
// 'password'=>'required|string|max:6|confirmed',
// 'token'=>'required'|'string'

// ]);
// $email_password_status = password::reset($credentials, function ($user,$password)){

// 	$user->password=$password;
// 	$usr->save();
// });

// if ($email_password_status==password::INVALID_TOKEN()) {
// // return$this->respondBadRequest(:"reset  password link sent to your email");
// return $this->badRequestResponse('reset  password link sent to your email');
// return $this->badsucessResponse('password sucessfuly changed');

	
// }


}
// }





// public function forgetPasswordReset(Request $request)
// {
// 		$attributes = $request->all();
// 		$user = User::where('email', $attributes['email'])->first();
// 		if (!$user) {
// 				return $this->badRequestResponse('This user is not found');
// 		}
// 		$user->fill([
// 				'password' => hash::make($attributes['password'])
// 		]);
// 		$user->save();
// 		$user->tokens()->delete();
// 		return $this->successResponse("Password reset successful", $user);
// }
// public function PasswordResettoken(Request $request)
//     {
//         if (empty($request->token)) return $this->badRequestResponse("Error");
//         $check = user::where('token', $request->token)->first();
//         if (is_Null($check)) return $this->badRequestResponse('Error invalid token');
//         return $this->successResponse("done", $check);
// 		}
// 		public function resendForgotpasswordOtp(Request $request)
//     {
//         $unique_secret = "";
//         $attributes = $request->all();
//         $user = User::where('email', $attributes['email'])->first();
//         $otp = user::digits(4)->expiry(1)->generate($unique_secret);
//         if (!$user) {
//             return $this->badRequestResponse('This user is not found');
//         }
//         PasswordReset::create([
//             'email' => $user->email,
//             'token' => $otp,
//         ]);
//         $user->notify(new ResetPasswordNotification(
//             $user,
//             $otp
//         ));
//         return $this->successResponse('done', $user);
//     }












//     public function register(loginRequest $request)
//     {
        
//         try {
//             $createUsers = User::create([
//                 'firstname' => $request->firstname,
//                 'lastname' => $request->lastname,
//                 'email' => $request->email,
//                 'password' => Hash::make($request->password),
//             ]);
          

   
                
        
//         } catch (\Throwable $th) {
//             //throw $th;
//             return $this->badRequestResponse("Error", ['errror' => $th->getMessage()]);
//         }
//         return $this->successResponse('sucessfuly created', $createUsers);
//     }
   

//     public function login(Request $request)
//     {

//         $fields = $request->validate([

//             'email' => 'required|string|email',
//             'password' => 'required|string',

//         ]);
//         try {

//                 $user = User::where('email', $fields['email'])->first();
            
//              if (!$user || !Hash::check($fields['password'], $user->password)) {
            
//                       return $this->badRequestResponse("Wrong Credentials");
//                   }
            
//               } catch (\Exception $e) {
            
//                    return $this->badRequestResponse($e->getMessage());
//                 }
            
            
//                 return $this->successResponse("User logged in", $user);
//     }
   
    
   
//  //
// }
