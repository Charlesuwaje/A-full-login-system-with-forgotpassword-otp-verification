<?php

namespace App\Http\Controllers\Auth;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\passwordResetRequest;
use App\Models\User;
use Illuminate\Http\Request;


class CodeCheckController extends Controller
{
    public function CodeCheck(Request $request)
    {
        $request->validate([
            'Token' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
            'Token' => $passwordReset->Token,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    } public function forgetPasswordReset(PasswordResetRequest $request)
    {
        $attributes = $request->all();
        $user = User::where('email', $attributes['email'])->first();
        if (!$user) {
            return $this->badRequestResponse('This user is not found');
        }
        $user->fill([
            'password' => hash::make($attributes['password'])
        ]);
        $user->save();
        $user->tokens()->delete();
        return $this->successResponse("Password reset successful", $user);
    }

    // public function forgetPasswordReset(passwordResetRequest $request)
    // {
    //     $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

    //     if ($passwordReset->isExpire()) {
    //         return $this->jsonResponse(null, trans('passwords.code_is_expire'), 422);
    //     }

    //     $user = User::firstWhere('email', $passwordReset->email);

    //     $user->update($request->only('password'));

    //     $passwordReset->delete();

    //     return $this->jsonResponse(null, trans('site.password_has_been_successfully_reset'), 200);
    // }
}
// public function forgetPasswordReset(PasswordResetRequest $request)
// {
//     $attributes = $request->all();
//     $user = User::where('email', $attributes['email'])->first();
//     if (!$user) {
//         return $this->badRequestResponse('This user is not found');
//     }
//     $user->fill([
//         'password' => hash::make($attributes['password'])
//     ]);
//     $user->save();
//     $user->tokens()->delete();
//     return $this->successResponse("Password reset successful", $user);
// }


// public function passwordReset(Request $request)
//     {
//         $request->validate([
//             'Token' => 'required|string|exists:reset_code_passwords',
//             'password' => 'required|string|min:6|confirmed',
//         ]);

//         // find the code
//         $passwordReset = ResetCodePassword::firstWhere('Token', $request->code);

//         // check if it does not expired: the time is one hour
//         if ($passwordReset->created_at > now()->addHour()) {
//             $passwordReset->delete();
//             return response(['message' => trans('passwords.code_is_expire')], 422);
//         }

//         // find user's email 
//         $user = User::firstWhere('email', $passwordReset->email);

//         // update user password
//         $user->update($request->only('password'));

//         // delete current code 
//         $passwordReset->delete();

//         return response(['message' =>'password has been successfully reset'], 200);
//     }
