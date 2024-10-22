<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\LoginService;
use App\Http\Services\RegisterService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function index()
    { 
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

        $userData = $request->only('email', 'password');
        $loginService = new LoginService();  
        $response = $loginService->authenticate($userData);

        if ($response['status']) {
            return redirect()->route('admin.dashboard')->with('success', $response['message']);
        } else {
            return redirect()->route('admin.login')->with('error', $response['message'])->withInput();
        }
    }
}
