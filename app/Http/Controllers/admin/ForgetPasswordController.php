<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    //
    public function forgot()
    {
        return view('admin.forgot');
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);
        $existingToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($existingToken) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update(['token' => $token]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
            ]);
        }
    
        Mail::send("admin.mailforgot", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
            $message->from('ronakmaheshwari200@gmail.com', 'Laravel');
        });
        return redirect()->back()->with('message', 'We have emailed your password reset link.');
    }

    public function showResetPasswordForm($token)
    {
        return view('admin.ResetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $tokenGet = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if (!$tokenGet) {
            return redirect()->back()->with('error', 'Session timed out, please request a new password link.');
        }

        $email = $tokenGet->email;
        User::where('email', $email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $email])->delete();

        Mail::send("admin.successmail", ['tokenGet' => $tokenGet], function ($message) use ($email) {
            $message->to($email);
            $message->subject("Password Updated");
            $message->from('ronakmaheshwari200@gmail.com', 'Laravel');
        });

        return redirect()->route('admin.login')->with('success', 'We have updated your password. Check your email for confirmation.');
    }
}
