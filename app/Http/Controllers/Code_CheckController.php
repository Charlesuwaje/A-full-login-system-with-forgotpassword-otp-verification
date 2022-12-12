<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\passwordResetRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;

class Code_CheckController extends Controller
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

}
