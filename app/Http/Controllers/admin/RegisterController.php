<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view('admin.register');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:10'
        ], [
            'password.min' => 'The password must contain at least 10 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $registerService = new RegisterService();
         $data       =   array(
                            'name'     =>  $request->input('name'),
                            'email'    =>  $request->input('email'),
                            'password' =>  $request->input('password'),
                        );
        $response       =   $registerService->Register($data);

        if ($response['status'] == 'success') {
            return redirect()->route('admin.login')->with('success', $response['message']);
        } 
      } 
      public function verifyToken(Request $request)
      {
          $request->validate([
              'remember_token' => 'required|string',
          ]);
  
          $token = $request->input('remember_token');
  
          $user = User::where('remember_token', $token)->first();
          if ($user) {
              $user->verified_at = true;
              $user->remember_token = null;
              $user->save();
  
              return redirect()->route('admin.login')->with('success', 'You can login now');
          } else {
              return redirect()->route('admin.login')->with('error', 'Invalid token');
          }
      }

}
